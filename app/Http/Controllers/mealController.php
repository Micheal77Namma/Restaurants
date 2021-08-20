<?php

namespace App\Http\Controllers;

use App\Models\meal;
use App\Models\mealType;
use Illuminate\Http\Request;
use DB;
use Image;
use Storage;
use File;
class mealController extends Controller
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
            $data=meal::select('*')
            ->where('description','like','%'.$search['value'].'%')
            ->skip($start)
            ->take($length)->get();
            $arr=array();
            foreach($data as $d){
                $type=mealType::find($d->mealTypeID)->name;
                $arr[]=array(
                'type'=>$type,
                'action'=>"<a href='meal/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>

                <a href='meal/".$d->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>

                <a href='meal/".$d->id."' class='btn btn-info'><i class='fas fa-info'></i> View </a>

                "

            );
        }
        $total_members=meal::count();

		$count=DB::select("select * from meals where description like '%".$search['value']."%'");
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


		return view('meal.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$meal=mealType::all();
		return view("meal.create",["mealType"=>$meal]);
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

		'description'=>'required',
		'price'=>'required',
		'mealTypeID'=>'required',
		]);




		$meal=new meal();
		$meal->description=$request->description;
		$meal->price=$request->price;
		$meal->mealTypeID=$request->mealTypeID;
        if( $request->hasFile('image'))    {
            $img = $request->file('image');
            $filename =  'meal/'.$img->getClientOriginalName();
            $meal->img=$filename;
            $location = storage_path('app/public/') . $filename;
            Image::make($img)->save($location);
		}

        $meal->save();

		return redirect()->route("meal.index")->with('success','Creating Done successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(meal $meal)
    {
        //
		return view("meal.show",["meal"=>$meal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(meal $meal)
    {
        $type=mealType::all();
		return view("meal.edit",["mealType"=>$type,"meal"=>$meal]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, meal $meal)
    {
			$meal->description=$request->description;
		$meal->price=$request->price;
		$meal->mealTypeID=$request->mealTypeID;
        if( $request->hasFile('image'))    {
            $img = $request->file('image');
            $filename =  'meal/'.$img->getClientOriginalName();
            $meal->img=$filename;
            $location = storage_path('app/public/') . $filename;
            Image::make($img)->save($location);
        }

        $meal->save();
        return redirect()->route("meal.index")->with('success','Editing Done successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(meal $meal)
    {
		DD("IA M HERE");
        //
    }

    public function deleted($id)
    {
		$meal=meal::find($id);
		$meal->delete();
		return redirect()->route("meal.index");
        //
    }
}
