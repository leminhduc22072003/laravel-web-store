<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
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
                    $request->session()->put('user', $user);
                    return redirect('/admin');
                } else {
                    $message = 'Tài khoản đã bị khóa';
                    return view('auth.login')->with(compact('message'));
                }
            } else {
                $message = 'Vui lòng kiểm tra lại tài khoản và mật khẩu';
                return view('auth.login')->with(compact('message'));
            }
        }
    }
    public function logout(Request $request)
    {
        if($request->id)
        {
            User::where(['id'=>$request->id])->update(['auth_token'=>null]);
            $request->session()->flash('message', 'Tài khoản đã đăng xuất');
            $request->session()->forget('user');
            $request->session()->forget('token');
            return redirect('/');
        }
        else
        {
            $request->session()->flash('message', 'Tài khoản không tồn tại');
            $request->session()->forget('user');
            $request->session()->forget('token');
            return redirect('/');
        }
    }
}
