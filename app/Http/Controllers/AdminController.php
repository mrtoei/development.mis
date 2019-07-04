<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use DB;
class AdminController extends Controller
{
    function index(){
        return view('admin.index');
    }
    function gallery(){
        return view('admin.gallery');
    }
    function user(){
        return view('admin.user');
    }
    function user_create(){
        return view('admin.user-create');
    }
    function user_edit($id){
        $user = DB::table('auth')
            ->join('resource','auth.em_id','=','resource.em_id')
            ->where('auth.id',$id)->get();    
        return view('admin.user-edit',compact('id'));
    }
    function profile(){
        return view('admin.profile');
    }
    function reset_password(){
       $password =Hash::make('admin');
       echo $password;
       
        $users = DB::table('auth')
                    ->where('username','admin')
                    //->where('password',$password)
                    ->get();
        echo "<pre>";
        print_r($users);
        echo "</pre>";
        // $pass = password_verify($password,$users->password);
        // if($pass){
        //     echo 'correct';
        // }
        foreach($users as $user){
            $pass = password_verify('admin',$user->password);
            if($pass){
                echo 'true';
            }else{
                echo 'false';
            }
            // echo 'id = '.$user->id.'<br>';
            // echo $user->em_shortcut." = ".Hash::make($user->em_shortcut).'<br>';
            // DB::table('auth')
            // ->where('id', $user->id)
            // ->update(['password' => Hash::make($user->em_shortcut)]);   
           
        }
    }
}
