<?php   

namespace App\Service\Modules;

use App\Service\Contracts\IAuthService;
use App\Repository\Contracts\IUserRepository;
use App\Repository\Contracts\IAnggotaRepository;
use Illuminate\Support\Facades\Hash;
use App\Model\DB\User;
use App\Model\DB\Anggota;
class AuthService implements IAuthService
{
    private $authRepository;
    private $anggotaRepository;
    public function __construct(
        IUserRepository $userRepository,
        IAnggotaRepository $anggotaRepository
    )
    {
        $this->anggotaRepository=$anggotaRepository;
        $this->userRepository=$userRepository;
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
            "Password" => Hash::make($data['password']),
            "Email" => $data['email'],
            "RoleID" => $data['role_id']
        ];
        $user=new User($userData);
        $resultUser=$this->userRepository->InsertUpdate($user);
        if($resultUser != null)
        {
            $anggotaData = [
                "UserID" => $resultUser['id'],
                "NamaLengkap" => $data['NamaLengkap'],
                "NIK" => $data['NIK'],
                "NoTelp" => $data['NoTelp']
            ];
            $anggota=new Anggota($anggotaData);
            $resultAnggota = $this->anggotaRepository->InsertUpdate($anggota);
        }
        return $resultUser;
    }
}