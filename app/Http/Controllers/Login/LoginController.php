<?php

namespace App\Http\Controllers\Login;

use App\Constant;
use App\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct() {
        DB::connection()->enableQueryLog();
    }
    public function getBackendLogin() {
        try{
            if(Auth::guard('admin')->user() != null){
                $role = Auth::guard('admin')->user()->role;
                if($role == Constant::ADMIN_ROLE){
                    return redirect('/sg-backend/index');
                }
            }
            $screen = "Login form Start";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('auth.backend_login');
        }catch(\Exception $e){
            $screen = "Login form post Method";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }

    }

    // public function getLoginForm() {
    //     try{
    //         return view('auth.login');
    //     }catch(\Exception $e){
    //         abort(500);
    //     }
    // }

    public function postLoginForm(AdminLoginRequest $request) {

        try{
            $credentials = Auth::guard('admin')->attempt([
                'username' => $request->username,
                'password' => $request->password,
                // 'role'     => Constant::ADMIN_ROLE,
            ]);
            if($credentials){
                $screen = "Login form post Method";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return redirect('/sg-backend/index');
            }else{
                return redirect()->back()->withErrors(['login-error' => 'Wrong credentials'])->withInput();
            }
        }catch(\Exception $e){
            $screen = "Login form post Method";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }

    }
    public function logout() {
        try{
            Auth::logout();
            Session::flush();
            $screen = "Logout Method";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return redirect('/sg-backend/login');
        }catch(\Exception $e){
            abort(500);
        }
    }
}
