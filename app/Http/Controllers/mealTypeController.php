<?php

namespace App\Http\Controllers;

use App\Models\mealType;
use App\Models\category;
use Illuminate\Http\Request;
use DB;
use Image;
use Storage;
use File;
class mealTypeController extends Controller
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
        $data=mealType::select('*')
        ->where('name','like','%'.$search['value'].'%')
        ->skip($start)
        ->take($length)->get();
        $arr=array();
        foreach($data as $d){

            $arr[]=array(
            'name'=>$d->name,
            'action'=>"<a href='mealType/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>

                <a href='mealType/".$d->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>

                "
            );
        }
        $total_members=mealType::count();

		$count=DB::select("select * from meal_types where name like '%".$search['value']."%'");
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


		return view('mealType.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

		return view("mealType.create");
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
            'name' => 'required',
        ]);

		$meal_type=new mealType();
		$meal_type->name=$request->name;

        $meal_type->save();

		return redirect()->route("mealType.index")->with('success','Creating Done successfully');;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\meal_type  $meal_type
     * @return \Illuminate\Http\Response
     */
    public function show(meal_type $meal_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meal_type  $meal_type
     * @return \Illuminate\Http\Response
     */
    public function edit(meal_type $meal_type)
    {
		return view("mealType.edit",["mealType",$meal_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\meal_type  $meal_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, meal_type $meal_type)
    {
        $meal_type->name=$request->name;
		$meal_type->save();
		return redirect()->route("mealType.index")->with('success','Editing Done successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meal_type  $meal_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(meal_type $meal_type)
    {
        //
    }

    public function deleted($id)
    {
		$mealT=mealType::find($id);
		$mealT->delete();
		return redirect()->route("mealType.index");

    }
}
