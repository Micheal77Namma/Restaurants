<?php

namespace App\Http\Controllers;

use App\Models\role;

use Illuminate\Http\Request;
use DB;

class roleController extends Controller
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
		 $data=role::select('*')
		 ->where('name','like','%'.$search['value'].'%')
		 ->skip($start)
		 ->take($length)->get();
		 $arr=array();
		 foreach($data as $d){

			 $arr[]=array(
			 'name'=>$d->name,

			 'action'=>"<a href='role/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>

			 <a href='role/".$d->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>

			 <a href='role/".$d->id."' class='btn btn-info'><i class='fas fa-info'></i> View </a>

			 "

			 );
		 }
		 $total_members=role::count();

		$count=DB::select("select * from roles where name like '%".$search['value']."%'");
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


		return view('role.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

		return view("role.create");
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
		$this->validate($request,[

		'name'=>'required',

		]);



		$role=new role();
		$role->name=$request->name;


         $role->save();

		return redirect()->route("role.index")->with('success','Creating Done successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {
        //
		return view("role.show",["role"=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {

		return view("role.edit",["role"=>$role]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
			$role->name=$request->name;


         $role->save();
		 	return redirect()->route("role.index")->with('success','Editing Done successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
		DD("IA M HERE");
        //
    }
	   public function deleted($id)
    {
		$role=role::find($id);
		$role->delete();
		return redirect()->route("role.index");

        //
    }
}
