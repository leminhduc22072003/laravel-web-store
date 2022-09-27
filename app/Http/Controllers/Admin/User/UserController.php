<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-admin-permission');
    }

    public function index() {
        $users = User::all();
        return view('admin.user.list')->with(compact('users'));
    }

    public function getForm() {
        return view('admin.user.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required|max:100',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'group' => 'required',
            'gender' => 'required',
            'active' => 'required',
            'email' => 'email|max:100',
        ];

        $messages = [
            'name.required' => 'tên trường không được để trống',
            'name.max' => 'tên trường không được quá 255 ký tự',
            'username.required' => 'tên đăng nhập không được để trống',
            'username.unique' => 'tên đăng nhập không được trùng nhau',
            'password.required' => 'mật khẩu không được bỏ trống',
            'group.required' => 'nhóm không được để trống',
            'gender.required' => 'mật khẩu không được để trống',
            'active.required' => 'trạng thái người dùng không được để trống',
            'email.email' => 'email phải là dạng email',
            'email.max' => 'email nhập tối đa 100 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $updateRequest = $request->all();
            unset($updateRequest['_token']);
            unset($updateRequest['password']);
            unset($updateRequest['avatar']);

            $updateRequest['password'] = Hash::make($request->password);
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $path = $image->store('User', 'public');
                $updateRequest['avatar'] = $path;
            }

            User::create($updateRequest);
            if (isset($path)) {
                $user = User::where('username', '=', $request->username)->update(['avatar' => $path]);
            }
            return redirect()->route('admin.user.list');
        }
    }

    public function editForm($id) {
        $user = User::FindOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required|max:100',
            'username' => 'required|unique:users,username,'.$id,
            'group' => 'required',
            'gender' => 'required',
            'active' => 'required',
            'email' => 'email|max:100',
        ];

        $messages = [
            'name.required' => 'tên trường không được để trống',
            'name.max' => 'tên trường không được quá 255 ký tự',
            'username.required' => 'tên đăng nhập không được để trống',
            'username.unique' => 'tên đăng nhập không được trùng nhau',
            'group.required' => 'nhóm không được để trống',
            'gender.required' => 'mật khẩu không được để trống',
            'active.required' => 'trạng thái người dùng không được để trống',
            'email.email' => 'email phải là dạng email',
            'email.max' => 'email nhập tối đa 100 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $user = User::where('id', '=', $id);
            $password = clone $user;
            $password = $password->first();
            if (!isset($request->password)) {
                $request['password'] = $password->password;
            } else {
                $request['password'] = Hash::make($request->password);
            }
            if ($request->hasFile('avatar')) {
                //xoa anh cu neu co
                $currentImg = $password->avatar;
                if ($currentImg) {
                    Storage::delete('/public/' . $currentImg);
                }
                //cap nhap anh moi
                $image = $request->file('avatar');
                $path = $image->store('User', 'public');
            }
            $updateRequest = $request->all();
            unset($updateRequest['_token']);
            unset($updateRequest['avatar']);
            if (isset($path)) {
                $updateRequest['avatar'] = $path;
            }
            $user->update($updateRequest);
            $user = User::FindOrFail($id);
            $request->session()->put('user', $user);
            return redirect()->route('admin.user.list');
        }
    }

    public function delete($id) {
        User::FindOrFail($id)->delete();
        $users = User::get();
        return redirect()->back()->with(compact('users'));
    }
}
