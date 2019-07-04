<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AuthController extends Controller
{
    function index(){
         return view('login/login');
    }
    function checklogin(Request $req)
    {
        $username  = $req->post('username');
        $password = $req->post('password');
        $users = DB::table('auth')->where('username', $username)->get();
        if($users->count()>0){
            foreach ($users as $user){
                $check_password = password_verify($password,$user->password);
                if($check_password){
                    $userArr = array(
                        'username' => $user->username,
                        'em_id' => $user->em_id,
                        'role' => $user->role
                    );
                    session()->put('data',$userArr);
                    $session = session()->get('data');
                    return redirect('/admin');
                }else{
                    return redirect('/');
                }
            }
        }else{
            return redirect('/');
        }
    }
    function logout(Request $req){
        $req->session()->flush(); 
        return  redirect('/');
    }
}
