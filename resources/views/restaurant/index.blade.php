@extends('adminlte::page')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
@section('content')
<a class="btn  btn-success" href="restaurant/create">create restaurant</a><br>
<br>
<table id="table_id" class="table table-dark">
<thead>
<th>name</th>
<th>category</th>
<th>Action</th>
</thead>
<tbody>
</tbody>
</table>
@endsection

<script>
$(document).ready( function () {
    $('#table_id').DataTable(
	{
		processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('restaurant-pagination') }}",
		},
        columns: [
            {data:'name'},
            {data:'category'},
            {data:'action'},
        ],
    })
} );
</script>
