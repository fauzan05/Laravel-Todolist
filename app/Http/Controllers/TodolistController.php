<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    public function __construct(protected TodolistService $todolistService){}
    public function show()
    {
        $todolist = $this->todolistService->getTodo();
        return response()->view('todolist.todolist', [
            'title' => 'Todolist',
            'todolist' => $todolist 
        ]);
    }

    public function add(Request $request)
    {
        $todo = $request->input('todo');
        if(empty($todo)){
            $todolist = $this->todolistService->getTodo();
            return response()->view('todolist.todolist', [
                'title' => 'Todolist',
                'todolist' => $todolist,
                'error' => 'Todo must be filled!'
            ]);
        }
        $this->todolistService->saveTodo(uniqid(), $todo);
        // return redirect('/todolist');
        return redirect()->action([TodolistController::class, 'show']);
    }

    public function remove(string $id): RedirectResponse
    {
        $this->todolistService->removeTodo($id);
        return redirect('/todolist'); 
    }   
}
