<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testAuthFilter()
    {
        $this->withSession([
            'User' => 'F3196813@gmail.com'
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testAuthSuccess()
    {
        $this->post('/login', [
            'username' => 'F3196813@gmail.com',
            'password' => 'fauzan123'
        ])->assertRedirect('/')
            ->assertSessionHas('User', 'F3196813@gmail.com');
    }
    public function testAuthForUser()
    {
        // if users has been already logging in, so just redirect to '/' and do nothing
        $this->withSession([
            'User' => 'F3196813@gmail.com'
        ])->post('/login', [
            'username' => 'F3196813@gmail.com',
            'password' => 'fauzan123'
        ])->assertRedirect('/');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertViewIs('user.login')
                ->assertSeeText('Username and Password must be filled!');
    }
 
    public function testLoginFailed()
    {
        $this->post('/login', [
            'username' => 'asd',
            'password' => 'asd'
        ])->assertSeeText('Username and Password are wrong!');
    }

    public function testLogout()
    {
        $this->withSession([
            'User' => 'F3196813@gmail.com'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('User');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/login');
    } 
}
