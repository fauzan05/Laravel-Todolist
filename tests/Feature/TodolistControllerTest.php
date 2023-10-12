<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolistView()
    {
        $this->withSession([
            'User' => 'F3196813@gmail.com',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'first todo'
                ],
                [
                    'id' => '2',
                    'todo' => 'second todo'
                ],
                [
                    'id' => '3',
                    'todo' => 'third todo'
                ]
            ]
        ])->get('/todolist')
                    ->assertSeeText('first todo');

    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'User' => 'F3196813@gmail.com'
        ])->post('/todolist', [])
            ->assertSeeText('Todo must be filled!');
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            'User' => 'F3196813@gmail.com'
        ])->post('/todolist', [
            'id' => '1',
            'todo' => 'first todo'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodo()
    {
        $this->withSession([
            'User' => 'F3196813@gmail.com',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'first todo'
                ],
                [
                    'id' => '2',
                    'todo' => 'second todo'
                ],
            ]
        ])->post('/todolist/1')
            ->assertRedirect('/todolist');
        $this->get('/todolist')
            ->assertSeeText('second todo');
    }

}
