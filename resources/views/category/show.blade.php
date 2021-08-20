@extends("adminlte::page")
@section('content')
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Category Name :</h5>
	<p>{{$category->name}}</p>
    <h5 class="card-title">Category description :</h5>
	<p>{{$category->description}}</p>
    <a href="/category" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
