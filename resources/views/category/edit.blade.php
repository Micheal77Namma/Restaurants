@extends('adminlte::page')

@section('content')
<form action="{{route('category.update',$category->id)}}" method="POST">
    @csrf
    {{method_field('PATCH')}}
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Name :</label></br>
            <div class="col-sm-10">
                <input value="{{$category->name}}" name="name" type="text" placeholder="Enter Name" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Description :</label></br>
            <div class="col-sm-10">
                <input value="{{$category->description}}" name="description" type="text" placeholder="Enter description" class="form-control">
            </div>
        </div>
    </fieldset>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
