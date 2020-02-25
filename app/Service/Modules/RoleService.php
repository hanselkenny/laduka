<?php   

namespace App\Service\Modules;

use App\Service\Contracts\IRoleService;
use App\Repository\Contracts\IRoleRepository;

class RoleService implements IRoleService
{
    private $roleRepository;

    public function __construct(IRoleRepository $roleRepository){
        $this->roleRepository=$roleRepository;
    }
    public function GetRoles()
    {
        return $this->roleRepository->FindAll()->withoutTimestamp();
    }
}