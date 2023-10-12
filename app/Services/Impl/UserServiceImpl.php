<?php 

namespace App\Services\Impl;
use App\Services\UserServices;

class UserServiceImpl implements UserServices
{
    private array $users = [
        "F3196813@gmail.com" => "fauzan123"
    ];
    public function login($username, $password):bool
    {
        if(!isset($this->users[$username])){
            return false;
        }
        $correctPassword = $this->users[$username];
        return $password == $correctPassword;
    }
}