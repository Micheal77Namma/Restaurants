@extends("adminlte::page")
@section('content')
<form action="{{route('role.update',$role->id)}}" method="POST" enctype="multipart/form-data">

@csrf
{{method_field('PATCH')}}
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 col-form-label">Role Name :</label></br>
        <div class="col-sm-10">
            <input value="{{$role->name}}" name="name" type="text" placeholder="Enter Role Name" class="form-control">
        </div>
    </div>
</fieldset>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
