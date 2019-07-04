<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use DB;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('resource')
            ->join('auth','auth.em_id','=','resource.em_id')
            ->where('resource.remove_status','0')->paginate(10);       
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = session()->get('data');
        //$em_id = Session::get('em_id');
        function generateRandomString() {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $strlen_name = strlen($request->get('name'));
        $strlen_lastname = strlen($request->get('lastname'));
        $backstr_name = 4-$strlen_name;
        $backstr_lastname = 3-$strlen_lastname;
        $shortcut_name =   mb_strtoupper(substr($request->get('name'),0,$backstr_name));
        $shortcut_lastname =   mb_strtoupper(substr($request->get('lastname'),0,$backstr_lastname));
        $hashtag = generateRandomString();
        $em_int_id = $shortcut_name.$shortcut_lastname.'-'.date("Ymd").'-'.date("Hi").'-'.$hashtag;
        $data_resource = array(
            'em_id' => $request->get('em_id'),
            'first_name'=> $request->get('name'),
            'last_name' =>$request->get('lastname'),
            'nickname'=> $request->get('nickname'),
            'gender'=> $request->get('gender'),
            'title'=> $request->get('title'),
            'birthday'=> $request->get('birthday'),
            'nationality'=> $request->get('nationality'),
            'street'=> $request->get('address'),
            'house_number'=> $request->get('housenumber'),
            'postal_code'=> $request->get('postalcode'),
            'email_private'=> $request->get('email'),
            'shortcut'=>$shortcut_name.$shortcut_lastname,
            'hashtag' => $hashtag,
            'em_int_id'=>$em_int_id,
            'role'=> $request->get('role'),
            'created' =>date("Y-m-d H:i:s"),
            'created_by' =>$session['em_id'],
            'remove_status'=> '0',
        );
        $data_auth = array(
            'username' => $shortcut_name.$shortcut_lastname,
            'email'=> $request->get('email'),
            'password' => Hash::make($shortcut_name.$shortcut_lastname),
            'role'=> $request->get('role'),
            'em_shortcut' => $shortcut_name.$shortcut_lastname,
            'em_int_id'=>$em_int_id,
            'status' => '1',
            'created' =>date("Y-m-d H:i:s"),
            'created_by' =>$session['em_id'],
        );
        $insert_resource = DB::table('resource')->insert($data_resource);
        $insert_auth = DB::table('auth')->insert($data_auth);
        if($insert_resource){
            if($insert_auth){
                return response()->json($insert_auth);
            }
        }
        // echo "<pre>";
        // print_r( session()->get('data'));
        // echo "</pre>";
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('auth')
            ->join('resource','auth.em_id','=','resource.em_id')
            ->where('auth.id',$id)->get();     
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DB::table('resource')
            ->where('id',$id)
            ->update(['remove_status' => 1]);
        return response()->json($user);
    }
}
