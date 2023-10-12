<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(protected UserServices $userServices){}

    public function login(): Response
    {
        return response()
            ->view('user.login', [
                'title' => 'Login Page'
            ]);
    }

    public function auth(Request $request): Response|RedirectResponse 
    {
        $username = $request->input('username');
        $password = $request->input('password');
        //validasi
        if(empty($username) || empty($password))
        {
            return response()
                    ->view('user.login', [
                        'title' => 'Login Page',
                        'error' => 'Username and Password must be filled!'
                    ]);
        }

        if($this->userServices->login($username, $password))
        {
            $request->session()->put('User', $username);
            return redirect('/');
        }

        return response()->view('user.login', [
            'title' => 'Login Page',
            'error' => 'Username and Password are wrong!'
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('User');
        return redirect('/');
    }
}
