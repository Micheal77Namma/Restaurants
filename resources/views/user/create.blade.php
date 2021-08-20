@extends("adminlte::page")
@section('content')
<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">

@csrf
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 col-form-label">Username :</label></br>
        <div class="col-sm-10">
            <input name="username" type="text" placeholder="Enter username" class="form-control">
        </div>
    </div>
</fieldset>
<fieldset>
    <div class="form-group">
        <label class="col-sm-2 col-form-label">Password :</label></br>
        <div class="col-sm-10">
            <input name="password" type="password" placeholder="Enter password" class="form-control">
        </div>
    </div>
</fieldset>

<div class="form-group">
    <label for="exampleSelect1" class="form-label mt-4">Role :</label>
    <select name="role_id">
        @foreach ($roleIds as $c)
        <option value="{{$c->id}}">{{$c->name}}</option>
        @endforeach
    </select>
</div>



<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
