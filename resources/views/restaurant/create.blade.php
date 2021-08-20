
@extends('adminlte::page')
@section('content')
<form action="{{route('restaurant.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Name :</label></br>
            <div class="col-sm-10">
                <input name="name" type="text" placeholder="Enter Name" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">City :</label></br>
            <div class="col-sm-10">
                <input name="city" type="text" placeholder="Enter City" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Address :</label></br>
            <div class="col-sm-10">
                <input name="address" type="text" placeholder="Enter address" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Description :</label></br>
            <div class="col-sm-10">
                <input name="description" type="text" placeholder="Enter description" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Duration :</label></br>
            <div class="col-sm-10">
                <input name="duration" type="text" placeholder="Enter duration" class="form-control">
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 col-form-label">Phone :</label></br>
            <div class="col-sm-10">
                <input name="phone" type="text" placeholder="Enter phone" class="form-control">
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <label for="exampleSelect1" class="form-label mt-4">Category Name :</label>
        <select class="form-select" id="exampleSelect1" name="category_id">
            @foreach ($category as $c)
            <option value="{{$c->id}}"> {{$c->name}} </option>
            @endforeach
        </select>
    </div>
    <input name="image" type="file" >
    </br>
    </br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
