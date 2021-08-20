@extends("adminlte::page")
@section('content')
<div class="card" style="width: 18rem;">
<img src="{{ asset('storage/' . $restaurant->image) }}" alt="photo" class="img-fluid">

  <div class="card-body">
    <h5 class="card-title">Restaurant City :</h5>
	<p>{{$restaurant->city}}</p>
    <h5 class="card-title">Restaurant Phone :</h5>
    <p>{{$restaurant->phone}}</p>
    <p class="card-text">{{$restaurant->description}}</p>
    <a href="/restaurant" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
