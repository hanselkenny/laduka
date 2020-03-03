<?php

namespace App\Service\Contracts;

interface IAuthService
{
    public function RegisterUser($data);
    public function RegisterAdmin($data);
    public function GetUserByEmailOrUsername($field);
}