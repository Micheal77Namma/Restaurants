@extends("adminlte::page")
@section('content')
<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">RoleName :</h5>
	<p>{{$role->name}}</p>
    <a href="/role" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
