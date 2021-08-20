<?php

namespace App\Http\Controllers;

use App\Models\restaurant;
use App\Models\category;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Storage;


class restaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function page(Request $request)
    {

        $start = $request->get('start');
        $length = $request->get('length');
		$search_arr = $request->get('search');
        $searchValue = $search_arr['value'];
        $rests = restaurant::select('*')
		->where('name', 'like', '%' . $searchValue . '%')
		->skip($start)
        ->take($length)
        ->get();

        $data_arr = array();

        foreach($rests as $r){
            $name = $r->name;
            $cat = category::find($r->category_id)->name;
            $data_arr[] = array(
                "name" =>$name,
                "category" => $cat,
                "action"=>"<a href='restaurant/".$r->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>

                <a href='restaurant/".$r->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>

                <a href='restaurant/".$r->id."' class='btn btn-info'><i class='fas fa-info'></i> View </a>

                "
        );
        }
		$total_members=restaurant::count();
        $count=DB::select("select * from restaurants where name like '%".$searchValue."%'");
        $recordsFiltered=count($count);
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data_arr,
        );

        echo json_encode($data);
    }

    public function index()
    {
        return view('restaurant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cat = category::all();
        return view('restaurant.create',['category'=>$cat]);
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

        $restaurant=new restaurant();
		$restaurant->name=$request->name;
		$restaurant->description=$request->description;
		$restaurant->phone=$request->phone;
		$restaurant->city=$request->city;
		$restaurant->address=$request->address;
		$restaurant->duration=$request->duration;
		$restaurant->category_id=$request->category_id;
        if( $request->hasFile('image'))    {
            $img = $request->file('image');
            $filename =  'restaurants/'.$img->getClientOriginalName();
            $restaurant->image=$filename;
            $location = storage_path('app/public/') . $filename;
            Image::make($img)->save($location);
            }

            $restaurant->save();
        return redirect()->route('restaurant.index')->with('success','Creating Done successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(restaurant $restaurant)
    {

        return view("restaurant.show",["restaurant"=>$restaurant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(restaurant $restaurant)
    {
        $cat = category::all();
        return view("restaurant.edit",["restaurant"=>$restaurant,"category"=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, restaurant $restaurant)
    {
        $restaurant->name=$request->name;
		$restaurant->description=$request->description;
		$restaurant->phone=$request->phone;
		$restaurant->city=$request->city;
		$restaurant->address=$request->address;
		$restaurant->duration=$request->duration;
        if( $request->hasFile('image'))    {
            $img = $request->file('image');
            $filename =  'restaurants/'.$img->getClientOriginalName();
            $restaurant->image=$filename;
            $location = storage_path('app/public/') . $filename;
            Image::make($img)->save($location);
        }

        $restaurant->save();
		return redirect()->route("restaurant.index")->with('success','Editing Done successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(restaurant $restaurant)
    {
        //
    }

    public function deleted($id)
    {
		$rest=restaurant::find($id);
		$rest->delete();
		return redirect()->route("restaurant.index");

    }
}
