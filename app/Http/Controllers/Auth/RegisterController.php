<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Model\DB\User;
use App\Model\DB\Role;
use App\Model\Requests\Auth\UserRegisterPostRequest;
use App\Service\Contracts\IRoleService;
use App\Service\Contracts\IAuthService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class RegisterController extends Controller
{

    private $roleService;
    private $authService;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
        /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IRoleService $roleService,IAuthService $authService)
    {
        $this->roleService=$roleService;
        $this->authService=$authService;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $roles = $this->roleService->GetRoles();
        $roles_dropdown = $roles->toDropdown('id','RoleName');
        return view('auth\register')->with([
            'rolesList' => $roles_dropdown
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'NamaLengkap' => ['required', 'string', 'max:50'],
    //         'Username' => ['required', 'string', 'max:50'],
    //         'NIK' => ['required', 'string', 'max:16'],
    //         'NoTelp' => ['required', 'int', 'max:13'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'role_id' => ['required', 'int']
    //     ]);
    // }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Model\Requests\Auth\UserRegisterPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterPostRequest $request)
    {
        event(new Registered($user = $this->create($request->validatedIntoCollection())));
        
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
    protected function create(Collection $data)
    {
        return $this->authService->RegisterUser($data);
    }
}
