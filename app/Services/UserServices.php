<?php

namespace App\Services;

interface UserServices
{ 
    function login(string $username, string $password):bool;
} 