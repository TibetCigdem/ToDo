@extends('layouts.app')

@section('styles')
<style>
    #outer
    {
        width:auto;
        text-align: center;
    }
    .inner
    {
        display: inline-block;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: purple;">
                <div class="card-header">{{ __('Dashboard') }}</div>
                

                <div class="card-body">

                @if (Session::has('alert-success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('alert-success')}}
                </div>
                @endif

                @if (Session::has('alert-info'))
                <div class="alert alert-info" role="alert">
                    {{Session::get('alert-info')}}
                </div>
                @endif

                @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('error')}}
                </div>
                @endif


                <a class="btn btn-sm btn-info" href="{{route('todos.create')}}">Create To-Do</a>
                <br><br>

               @if (count($todos) > 0)
               <table class="table">
                    <thead>
                        <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                            <tr>
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->description}}</td>
                                <td>
                                   @if ($todo->status == 1)
                                    <a class="btn btn-sm btn-success" href="">Completed</a>
                                   @else
                                    <a class="btn btn-sm btn-secondary" href="">Not Completed</a>
                                   @endif
                                </td>
                                <td id="outer">
                                    <a class="inner btn btn-sm btn-warning" href="{{route('todos.show', $todo->id)}}">View</a>
                                    <a class="inner btn btn-sm btn-dark" href="{{route('todos.edit', $todo->id)}}">Edit</a>
                                    <form method="post" action="{{route('todos.destroy')}}"  class="inner">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="todo_id" value="{{$todo->id}}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

               @else
                <h4>There isn't any To-Do created</h4>
               @endif
                


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
