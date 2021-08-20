@extends("adminlte::page")
@section('content')
<form action="{{route('meal.update',$meal->id)}}" method="POST" enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 col-form-label">Description :</label></br>
        <div class="col-sm-10">
            <input value="{{$meal->description}}" name="description" type="text" placeholder="Enter description" class="form-control">
        </div>
    </div>
</fieldset>
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 col-form-label">Price :</label></br>
        <div class="col-sm-10">
        <input  value="{{$meal->price}}"name="price" type="text" placeholder="Enter Price" class="form-control">
        </div>
    </div>
</fieldset>
<div class="form-group">
    <label for="exampleSelect1" class="form-label mt-4">Meal Type :</label>
    <select class="form-select" id="exampleSelect1" name="mealTypeID">
        @foreach ($mealType as $c)
        <option value="{{$c->id}}">{{$c->name}}</option>
        @endforeach
    </select>
</div>
<input name="image" type="file" >
</br>
</br>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
