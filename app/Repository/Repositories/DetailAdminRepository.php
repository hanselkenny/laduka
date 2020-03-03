<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IDetailAdminRepository;
use App\Model\DB\DetailAdmin;

class DetailAdminRepository extends BaseRepository implements IDetailAdminRepository
{
    public function __construct() {
        parent::__construct(new DetailAdmin());
    }
}