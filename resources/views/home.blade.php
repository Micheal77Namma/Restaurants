@extends('layouts.app')
@include('includes.messages')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Please Log in') }}
                    <br>
                    <br>

                    <h4>The Passwords:</h4>
                    <h5>
                        admin
                        <small class="text-muted">(see every thing)</small>
                        password: 123456
                    </h5>
                    <h5>
                        restaurant
                        <small class="text-muted">(see restaurant only)</small>
                        password: 123456
                    </h5>
                    <h5>
                        meal
                        <small class="text-muted">(see meal, mealType and category)</small>
                        password: 123456
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
