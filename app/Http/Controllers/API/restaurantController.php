<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\restaurant;
use App\Models\category;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Storage;
use Validator;



class restaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return restaurant::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|unique:restaurants',
            'description'=> 'required',
        ]);
        if($validator->fails()){
            return response(['error'=>$validator->errors(),'Validation Error'],400);
        }

        try{
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
        }catch(\Exception $e){
            return response("internal server error",500);
        }

            return $restaurant;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(restaurant $restaurant)
    {
        return restaurant::all();
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
        try{
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
    }catch(\Exception $e){
        return response("internal server error",500);
    }
    return $restaurant;
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(restaurant $restaurant)
    {
        $rest=restaurant::find($id);
		$rest->delete();
    }
}
