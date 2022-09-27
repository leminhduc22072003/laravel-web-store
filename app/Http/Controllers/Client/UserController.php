<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getLogin() {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        return view('client.user.login', compact( 'categories'));
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'username.required' => 'Tài khoản không được để trống',
            'password.required' => 'Mật khẩu xác nhận không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $user = User::where(['username' => $request->username])->first();
            if ($user && Hash::check($request->password, $user->password)) {
                if ($user->active == 1) {
                    $token = $user->getAuthToken();
                    $data = $user->toArray();
                    if ($token == '') {
                        $data['auth_token'] = sha1('[' . $user->id . '-' . date('Y-m-d H:i:s') . ']');
                        $token = $data['auth_token'];
                    }
                    User::where(['id' => $user->id])->update($data);
                    $user = $user->toArray();
                    $request->session()->put('token', $token);
                    $request->session()->put('userClient', $user);
                    return redirect('/');
                } else {
                    $message = 'Tài khoản đã bị khóa';
                    return view('client.user.login')->with(compact('message'));
                }
            } else {
                $message = 'Vui lòng kiểm tra lại tài khoản và mật khẩu';
                return view('client.user.login')->with(compact('message'));
            }
        }
    }

    public function getRegister() {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        return view('client.user.register', compact( 'categories'));
    }

    public function register(Request $request) {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'username' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên khách hàng không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là số',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email phải thuộc định dạng email@mail.com',
            'username.required' => 'tên đăng nhập không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $userDetail = [
                'email' => $request->email,
                'username' => $request->username,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'group' => 3,
                'active' => 1
            ];
            $checkUser = User::where('email', $request->email)->first();
            if (empty($checkUser)) {
                $user = User::create($userDetail);
            }
            if (!empty($user)) {
                $request->session()->put('userClient', $user);
                return redirect()->route('client.dashboard');
            }
        }
    }

    public function checkOrder(Request $request) {
        if (!empty($request->session()->get('userClient'))) {
            $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
            $user = $request->session()->get('userClient');
            $orders = Order::where('user_id', $user['id'])->with('orderProduct', 'orderProduct.product')->get();
            return view('client.user.order', compact( 'categories', 'orders'));
        } else {
            return redirect()->route('client.dashboard');
        }

    }

    public function getDetail(Request $request) {
        if (!empty($request->session()->get('userClient'))) {
            $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
            return view('client.user.detail', compact( 'categories'));
        } else {
            return redirect()->route('client.dashboard');
        }
    }

    public function changeDetail(Request $request) {
        $rules = [
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'username' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên khách hàng không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là số',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email phải thuộc định dạng email@mail.com',
            'username.required' => 'tên đăng nhập không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $user = $request->session()->get('userClient');
            $data = $request->all();
            if (empty($data->password)) {
                $data->password = $user->password;
            } else {
                $data->password = Hash::make($data->password);
            }
            if (empty($checkUser)) {
                $user = User::FindOrFail($user->id)->update($data);
            }
            if (!empty($user)) {
                $request->session()->put('userClient', $user);
                return redirect()->back();
            }
        }
    }

    public function logout(Request $request)
    {
        if($request->id)
        {
            User::where(['id'=>$request->id])->update(['auth_token'=>null]);
            $request->session()->flash('message', 'Tài khoản đã đăng xuất');
            $request->session()->forget('userClient');
            $request->session()->forget('token');
            return redirect('/');
        }
        else
        {
            $request->session()->flash('message', 'Tài khoản không tồn tại');
            $request->session()->forget('userClient');
            $request->session()->forget('token');
            return redirect('/');
        }
    }
}
