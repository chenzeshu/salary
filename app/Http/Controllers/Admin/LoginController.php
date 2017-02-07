<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

require_once "/resources/org/code/Code.class.php";

class LoginController extends CommonController
{
    public function login()
    {
        if ($input = Input::all()){
            $code = new \Code();
            $_code = $code->get();
            if (strtoupper($input['code'])==$_code){
                $user = User::where('user_name',$input['user_name'])->first();
                if ($user['user_name']==$input['user_name']&&Crypt::decrypt($user['user_pass'])==$input['user_pass']){
                    //保存session
                    Session::put('username',$user['user_name']);
                    Session::put('userid',$user['id']);
                    return redirect('admin/index');
                }else{
                    return back()->with('msg','用户名或密码错误');
                }
            }else{
                return back()->with('msg','验证码错误');
            }
        }

        return view('admin/login');

     }

    public function code()
    {
          $code = new \Code;
          echo $code->make();
     }

    public function logout()
    {
        session(['userid'=>null]);
        session(['username'=>null]);
        return redirect('admin/login');
    }

    public function register()
    {
        $_pass = Crypt::encrypt(666666);
        dd($_pass);
        return view('admin/register');
    }
}
