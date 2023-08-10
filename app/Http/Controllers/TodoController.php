<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::where('user_id', Auth::id())->get();
        return view('todos.index',[
            'todos' => $todos
        ]);
    }
    public function create(){
        return view('todos.create');
    }    
    public function store(TodoRequest $request){
        //Erase user id if necessary
        Todo::create([
            'user_id'=>Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 0

        ]);

        $request->session()->flash('alert-success',' To-Do Created Successfully');

        return to_route('todos.index');
    }

    public function show($id){
        $todo = Todo::find($id);
        if(! $todo){
            request()->session()->flash('error',' Unable to locate To-Do');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate To-Do'
            ]);
        }
        return view('todos.show',['todo'=> $todo]);
    }

    public function edit($id) {
        $todo = Todo::find($id);
        if(! $todo){
            request()->session()->flash('error',' Unable to locate To-Do');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate To-Do'
            ]);
        }
        return view('todos.edit',['todo'=> $todo]);
    }

    public function update(TodoRequest $request){
        $todo= Todo::find($request->todo_id);
        if(! $todo){
            request()->session()->flash('error',' Unable to locate To-Do');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate To-Do'
            ]);
        }
        $todo->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status
        ]);
        request()->session()->flash('alert-info',' To-Do Updated Successfully');
        return to_route('todos.index');
    }

    public function destroy(Request $request){
        $todo= Todo::find($request->todo_id);
        if(! $todo){
            request()->session()->flash('error',' Unable to locate To-Do');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate To-Do'
            ]);
        }

        $todo->delete();
        $request->session()->flash('alert-success',' To-Do Deleted Successfully');
        return to_route('todos.index');
    }
}
