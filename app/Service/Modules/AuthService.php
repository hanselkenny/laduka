<?php   

namespace App\Service\Modules;

use App\Model\DB\User;
use App\Model\DB\Admin;
use App\Model\DB\DetailUser;
use App\Model\DB\DetailAdmin;
use App\Service\Contracts\IAuthService;
use App\Repository\Contracts\IUserRepository;
use App\Repository\Contracts\IDetailUserRepository;
use App\Repository\Contracts\IAdminRepository;
use App\Repository\Contracts\IDetailAdminRepository;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    private $userRepository;
    private $detailUserRepository;
    private $adminRepository;
    private $detailAdminRepository;
    public function __construct(IUserRepository $userRepository,IAdminRepository $adminRepository,IDetailUserRepository $detailUserRepository,IDetailAdminRepository $detailAdminRepository)
    {
        $this->detailUserRepository=$detailUserRepository;
        $this->userRepository=$userRepository;
        $this->detailAdminRepository = $detailAdminRepository;
        $this->adminRepository = $adminRepository;
    }
    public function GetUserByEmailOrUsername($field){
        $user = $this->userRepository->FindByUsername($field);
        if (!is_null($user))
            return $user;

        $user = $this->userRepository->FindByEmail($field);
        if (!is_null($user))
            return $user;

        return null;
    }

    public function RegisterUser($data)
    {
        $userData = [
            "Username" => $data['Username'],
            "password" => Hash::make($data['password']),
            "email" => $data['email']
        ];
        $user=new User($userData);
        $resultUser=$this->userRepository->InsertUpdate($user);
        if($resultUser != null)
        {
            $detailUserData = [
                "UserID" => $resultUser['id'],
                "NamaLengkap" => $data['NamaLengkap'],
                "NIK" => $data['NIK'],
                "NoTelp" => $data['NoTelp']
            ];
            $detail=new DetailUser($detailUserData);
            $resultDetailUser = $this->detailUserRepository->InsertUpdate($detail);
        }
        return $resultUser;
    }

    public function RegisterAdmin($data)
    {
        $adminData = [
            "Username" => $data['Username'],
            "password" => Hash::make($data['password']),
            "email" => $data['email'],
            "RoleID" => $data['role_id']
        ];
        $admin=new Admin($adminData);
        $resultAdmin=$this->adminRepository->InsertUpdate($admin);
        if($resultAdmin != null)
        {
            $detailAdminData = [
                "AdminID" => $resultAdmin['id'],
                "NamaLengkap" => $data['NamaLengkap'],
                "NomorKaryawan" => $data['NomorKaryawan'],
                "NoTelp" => $data['NoTelp']
            ];
            $detail=new DetailAdmin($detailAdminData);
            $resultDetailAdmin = $this->detailAdminRepository->InsertUpdate($detail);
        }
        return $resultAdmin;
    }
}