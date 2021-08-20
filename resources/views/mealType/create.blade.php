@extends("adminlte::page")
@section('content')
<form action="{{route('mealType.store')}}" method="POST" enctype="multipart/form-data">

@csrf
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 col-form-label">Name :</label></br>
        <div class="col-sm-10">
            <input name="name" type="text" placeholder="Enter Name" class="form-control">
        </div>
    </div>
</fieldset>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
