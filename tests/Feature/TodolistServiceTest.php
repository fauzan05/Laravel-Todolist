<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo('1', 'first todo');
        $todolist = Session::get('todolist');
        foreach($todolist as $todo){
            self::assertEquals('1', $todo['id']);
            self::assertEquals('first todo', $todo['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        self::assertEquals([], $this->todolistService->getTodo());
    }

    public function testGetTodolistExist()
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'first todo'
            ],
            [
                'id' => '2',
                'todo' => 'second todo'
            ]
        ];
        $this->todolistService->saveTodo('1', 'first todo');
        $this->todolistService->saveTodo('2', 'second todo');
        self::assertEquals($expected, $this->todolistService->getTodo()); 
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo('1', 'first todo');
        $this->todolistService->saveTodo('2', 'second todo');
        $this->todolistService->saveTodo('3', 'third todo');
        self::assertEquals(3, sizeof($this->todolistService->getTodo()));
        $this->todolistService->removeTodo('1');
        self::assertEquals(2, sizeof($this->todolistService->getTodo()));
         
    }
}
