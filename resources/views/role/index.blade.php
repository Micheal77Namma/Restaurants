@extends('adminlte::page')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
@section('content')
<a class="btn  btn-success" href="role/create">create role</a>

<table id="mytable" class="display">
<thead>
<tr>
<th>name</th>

<th>action</th>


</tr>
</thead>
<tbody>
<tr>
</tr>


</tbody>
</table>
@endsection

<script>

$(document).ready( function () {
    $('#mytable').DataTable({
		processing: true,
		serverSide:true,

		ajax:{
			url: "{{'role-pagination'}}",
		},
	 columns: [
            {data:'name'},

			{data:'action'},

			 ],

	})
	});
</script>
