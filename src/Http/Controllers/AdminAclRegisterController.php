<?php

namespace Pigs\AdminAclSetting\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Pigs\AdminAclSetting\Models\Account;

class AdminAclRegisterController extends Controller
{
    public function register()
    {
        return view('adm_acl_setting::pages.auth.register');
    }

    public function postRegister(Request $request)
    {
        try {
            DB::beginTransaction();
            $data               = $request->except('_token', 'avatar');
            $data['created_at'] = Carbon::now();
            $data['password']   = bcrypt($request->password);
            $data['status']     = $request->status ?? 1;

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $user     = Account::create($data);

            if ($user) {

                Auth::loginUsingId($user->id);
//                Mail::to($user->email)->queue(new SendEmailRegisterUser($user));
            }
            DB::commit();
            return redirect()->route('get.adm_acl_setting.login');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("ERROR => UserController@store => " . $exception->getMessage());
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('get.adm_acl_setting.login');
    }
//    public function restartPassword()
//    {
//        return view('frontend.auth.restart_password');
//    }
//
//    public function checkRestartPassword(CheckEmailRequest $request)
//    {
//        $email = $request->email;
//        $user = User::where('email', $email)->first();
//        if (!$user) {
//            toastr()->error('Không tồn tại tài khoản tương ứng!', 'Thông báo');
//            return redirect()->back();
//        }
//
//        $token = bcrypt($email) . bcrypt($user->id);
//        $passwordResets = DB::table('password_resets')
//            ->insert([
//                'email' => $email,
//                'token' => $token,
//                'created_at' => Carbon::now()
//            ]);
//
//        if (!$passwordResets) {
//            toastr()->error('Xử lý dữ liệu thất bại, xin vui lòng kiểm tra lại!', 'Thông báo');
//            return redirect()->back();
//        }
//
//        $link = route('get.new_password',['token' => $token]);
//
//        Mail::to($user->email)
//            ->cc('truongnguyen24@gmail.com')
//            ->queue(new SendEmailResetPassword($user, $link));
//
//        return  redirect()->route('get.alert_new_password');
//    }
//
//    public function alertNewPassword()
//    {
//        return view('frontend.auth.alert_re_new_password');
//    }
//
//    public function newPassword(Request $request)
//    {
//        $token = $request->token;
//
//        $passwordResets = DB::table('password_resets')
//            ->where('token', $token)->first();
//
//        if (!$passwordResets) {
//            toastr()->error('Thông tin không hợp lệ, xin vui lòng kiểm tra lại!', 'Thông báo');
//            return redirect()->route('get.restart_password');
//        }
//
//        // check token hết hạn chưa
//        return view('frontend.auth.new_password');
//    }
//
//    public function processNewPassword(UpdateNewPassword $request)
//    {
//        $token = $request->token;
//
//        $passwordResets = DB::table('password_resets')
//            ->where('token', $token)->first();
//
//        if (!$passwordResets) {
//            toastr()->error('Thông tin không hợp lệ, xin vui lòng kiểm tra lại!', 'Thông báo');
//            return redirect()->route('get.restart_password');
//        }
//
//        User::where('email', $passwordResets->email)
//            ->update([
//                'password' => bcrypt($request->password),
//                'updated_at' => Carbon::now()
//            ]);
//
//        DB::table('password_resets')
//            ->where('token', $token)->delete();
//
//        toastr()->success('Đổi mật khẩu thành công, xin vui lòng đăng nhập lại!', 'Thông báo');
//        return  redirect()->route('get.login');
//    }
//
//    public function verifyAccount(Request $request)
//    {
//        $email = $request->email;
//        $user = User::where('email', $email)->first();
//        if(!$user) {
//            toastr()->error('Không tồn tại tài khoản, xin vui lòng đăng ký tài khoản!', 'Thông báo');
//            return redirect()->route('get.register');
//        }
//
//        if ($user->status == User::STATUS_ACTIVE) {
//            toastr()->error('Tài khoản đã được kích hoạt, xin vui lòng đăng nhập!', 'Thông báo');
//            return redirect()->route('get.login');
//        }
//        $user->status = User::STATUS_ACTIVE;
//        $user->updated_at = Carbon::now();
//        $user->save();
//
//        toastr()->success('Kích hoạt tài khoản thành công, xin vui lòng đăng nhập!', 'Thông báo');
//        if (get_data_user('web')) return redirect()->route('get.home');
//
//        return redirect()->route('get.login');
//    }
//
//    public function resendVerifyAccount(Request $request)
//    {
//        $user = Auth::user();
//        toastr()->success('Đăng ký thành công, xin vui lòng kiểm tra email và kích hoạt tài khoản!', 'Thông báo');
//        Mail::to($user->email)->queue(new SendEmailRegisterUser($user));
//        return redirect()->route('get.home');
//    }
}
