<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IAdminRepository;
use App\Model\DB\Admin;

class AdminRepository extends BaseRepository implements IAdminRepository
{
    public function __construct() {
        parent::__construct(new Admin());
    }
    // public function FindByUsername($username)
    // {
    //     return User::where('username', '=', $username)->first();
    // }

    // public function FindByEmail($email)
    // {
    //     return User::where('email', '=', $email)->first();
    // }
}