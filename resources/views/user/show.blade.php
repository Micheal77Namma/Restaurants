@extends("adminlte::page")
@section('content')
<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">UserName :</h5>
	<p>{{$user->username}}</p>
    <a href="/user" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
