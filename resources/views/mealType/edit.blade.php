@extends("adminlte::page")
@section('content')
<form action="{{route('mealType.update',$mealType->id)}}" method="POST" enctype="multipart/form-data">

@csrf
{{method_field('PATCH')}}
<input name="name" type="text" placeholder="Enter Name" value="{{$mealType->name}}">
</br>
</br>
</form>
@endsection
