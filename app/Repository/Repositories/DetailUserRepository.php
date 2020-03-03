<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IDetailUserRepository;
use App\Model\DB\DetailUser;

class DetailUserRepository extends BaseRepository implements IDetailUserRepository
{
    public function __construct() {
        parent::__construct(new DetailUser());
    }
}