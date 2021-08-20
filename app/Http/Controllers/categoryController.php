<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use File;
use Storage;

class categoryController extends Controller
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
        $records = category::select('*')
		->where('name', 'like', '%' . $searchValue . '%')
		->skip($start)
        ->take($length)
        ->get();

        $data_arr = array();

        foreach($records as $record){

            $name = $record->name;
            $description = $record->description;
            $data_arr[] = array(
                "name" => $name,
                "Action"=>"<a href='category/".$record->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i> Edit</a>

                <a href='category/".$record->id."/deleted'  class='btn btn-danger'><i class='fas fa-trash'></i> Delete </a>

                <a href='category/".$record->id."' class='btn btn-info'><i class='fas fa-info'></i> View </a>

                "
        );
        }
		$total_members=category::count();
        $count=DB::select("select * from categories where name like '%".$searchValue."%'");
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
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'description' => 'required'
        ]);
        category::create($request->all());
        return redirect()->route('category.index')->with('success','Creating Done successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        return view("category.show",["category"=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view("category.edit",["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $category->name=$request->name;
		$category->description=$request->description;
		$category->save();
		return redirect()->route("category.index")->with('success','Editing Done successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
    public function deleted($id)
    {
		$cat=category::find($id);
		$cat->delete();
		return redirect()->route("category.index");

    }
}
