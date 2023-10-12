<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserServices $userService;

    protected function setUp():void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserServices::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login('F3196813@gmail.com', 'fauzan123'));
    }

    public function testLoginFailed()
    {
        self::assertFalse($this->userService->login('zane', 'haha'));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login('F3196813@gmail.com', 'asd'));
    }
}
