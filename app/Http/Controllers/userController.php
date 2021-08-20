<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\role;
use Illuminate\Http\Request;
use DB;
use Image;
use Storage;
use File;
use Hash;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function page(Request $r){
		 $length=$r->get('length');
		 $start=$r->get('start');
		 $search=$r->get('search');
		 $data=user::select('*')
		 ->where('username','like','%'.$search['value'].'%')
		 ->skip($start)
		 ->take($length)->get();
		 $arr=array();
		 foreach($data as $d){
			  $type=role::find($d->role_id)->name;
			 $arr[]=array(
			 'username'=>$d->username,
			 'password'=>$d->password,
			 'role'=>$type,
			 'action'=>"<a href='user/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>

			 <a href='user/".$d->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>

			 <a href='user/".$d->id."' class='btn btn-info'><i class='fas fa-info'></i> View </a>

			 "

			 );
		 }
		 $total_members=user::count();

		$count=DB::select("select * from users where username like '%".$search['value']."%'");
		$recordsFiltered=count($count);
        $data = array(

            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );

		 echo json_encode($data);
	 }

    public function index()
    {


		return view('user.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user=role::all();
		return view("user.create",["roleIds"=>$user]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function store(Request $request)
    {
		$this->validate($request,[

		'username'=>'required|unique:users',
		'password'=>'required',

		]);




		$user=new user();
		$user->username=$request->username;
		$user->password=Hash::make($request->password);
		$user->token=$this->generateRandomString();
		$user->role_id=$request->role_id;
        $user->save();

		return redirect()->route("user.index")->with('success','Creating Done successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
		return view("user.show",["user"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
			$type=role::all();
		return view("user.edit",["roleIds"=>$type,"user"=>$user]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $user->username=$request->username;
		$user->password=Hash::make($request->password);
        $user->token=$this->generateRandomString();
        $user->save();
        return redirect()->route("user.index")->with('success','Editing Done successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
		DD("IA M HERE");
        //
    }
	   public function deleted($id)
    {
		$user=user::find($id);
		$user->delete();
		return redirect()->route("user.index");

        //
    }
}
