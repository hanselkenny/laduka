<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IAnggotaRepository;
use App\Model\DB\Anggota;

class AnggotaRepository extends BaseRepository implements IAnggotaRepository
{
    public function __construct() {
        parent::__construct(new Anggota());
    }
}