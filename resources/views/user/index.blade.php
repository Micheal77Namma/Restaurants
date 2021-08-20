@extends('adminlte::page')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
@section('content')
<a class="btn  btn-success" href="user/create">create user</a>

<table id="mytable" class="display">
<thead>
<tr>
<th>username</th>
<th>role</th>
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
			url: "{{'user-pagination'}}",
		},
	 columns: [
            {data:'username'},
		   {data:'role'},
			{data:'action'},

			 ],

	})
	});
</script>
