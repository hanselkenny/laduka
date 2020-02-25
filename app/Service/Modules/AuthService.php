<?php   

namespace App\Service\Modules;

use App\Service\Contracts\IAuthService;
use App\Repository\Contracts\IUserRepository;
use App\Repository\Contracts\IAnggotaRepository;
use Illuminate\Support\Facades\Hash;

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
    public function RegisterUser($data)
    {
        $user = [
            "Username" => $data['Username'],
            "Password" => Hash::make($data['Password']),
            "Email" => $data['email'],
            "RoleID" => $data['role_id']
        ];
        $resultUser=$this->userRepository->InsertUpdate($user);
        if($resultUser != null)
        {
            $anggota = [
                "UserID" => $resultUser['id'],
                "NamaLengkap" => $data['NamaLengkap'],
                "NIK" => $data['NIK'],
                "NoTelp" => $data['NoTelp']
            ];
            $resultAnggota = $this->anggotaRepository->InserUpdate($anggota);
        }
        return $resultUser;
    }
}