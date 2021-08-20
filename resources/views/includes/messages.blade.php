@if (count($errors) > 0)
    @foreach ($errors->all() as $r)
        <div class="alert alert-dismissible alert-danger">
            <strong>Oh snap!</strong> {{$r}}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-dismissible alert-success">
        <strong>Well done!</strong> {{session('success')}}</a>.
    </div>
@endif



@if (session('error'))
    <div class="alert alert-dismissible alert-danger">
        <strong>Oh snap!</strong> {{session('error')}} and try submitting again.
    </div>

@endif
