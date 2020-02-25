<?php

namespace App\Service\Contracts;

interface IAuthService
{
    public function RegisterUser($data);
    public function GetUserByEmailOrUsername($field);
}