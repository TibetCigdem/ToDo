@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary">Go Back</a> <br><br>
                    <b>Your To-Do Title is: </b> {{ $todo->title }} <br>
                    <b>Your To-Do Description is: </b> {{ $todo->description }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
