<?php
namespace App\Http\Controllers\Admin;
use App\Jobs\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
class ForgotPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email'
            ]);
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            if($user->active == 0)
            {
                $error = 'tài khoản đã bị khóa';
                return redirect()->back()->with('error', $error);
            }
            else
            {
                $request->extra_token = mt_rand(1111111111, 9999999999) .time() . mt_rand(1111111111, 9999999999);
                if ($user->fill(['extra_token' => $request->extra_token])->save())
                {
                    $activationLink = URL::to('/auth/reset-password/'.$request->extra_token);
                    dispatch(new SendMail
                    (
                        1,
                        [
                            'to' => $request->email,
                        ],
                        [
                            'name'=>$user->name,
                            'email'=>$request->email,
                            'link'=>$activationLink
                        ]
                    ));
                    /* ---------- Send activation mail } ---------- */
                }
                $success = 'chúng tôi đã gửi link reset mật khẩu';
                return redirect()->back()->with('success', $success);
            }
        }
        else
        {
            $error = 'Email không tồn tại';
            return redirect()->back()->with('error', $error);
        }
    }
    protected function getDiffInMinutes($time) {
        $timetoDiff = Carbon::parse(date('Y/m/d H:i:s', $time));
        $now = Carbon::parse(date('Y/m/d H:i:s', time()));
        return $now->diffInMinutes($timetoDiff);
    }
    public function getFormResetPassword($extra_token) {
        return view('auth.recover-password')->with(compact('extra_token'));
    }
    public function resetPasswordChange(Request $request, $extra_token)
    {
        $time_token = substr($extra_token, 10 , -10);
        $expire_token = $this->getDiffInMinutes($time_token);
        if ($expire_token > 5) {
            return redirect()->route('auth.getForgotPassword')->with('error', 'đã hết thời gian đổi mật khẩu');
        }
        $rules = [
            'password' => 'required',
            'comfirm_password' => 'required',
        ];
        $messages = [
            'password.required' => 'Mật khẩu không được để trống',
            'comfirm_password.required' => 'Mật khẩu không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $user = User::where(['extra_token'=>$extra_token])->first();
            $newPassword =  Hash::make($request->password);
            if($user)
            {
                $updateData =
                    [
                        'extra_token'=>null,
                        'password' => $newPassword,
                    ];
                $user = User::where(['id'=>$user->id])->update($updateData);
                if($user)
                {
                    return redirect()->route('auth.getLogin')->with('success', 'Mật khẩu đã thay đổi thành công');
                }
                else
                {
                    return redirect()->route('auth.getLogin')->with('error', 'Mật khẩu không thể thay đổi');
                }
            }
            else
            {
                return redirect()->route('auth.getForgotPassword')->with('error', 'token reset không còn hiệu lực');
            }
        }
    }
}
