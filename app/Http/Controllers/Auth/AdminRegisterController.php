<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Model\DB\Admin;
use App\Model\DB\Role;
use App\Model\Requests\Auth\AdminRegisterPostRequest;
use App\Service\Contracts\IRoleService;
use App\Service\Contracts\IAuthService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class AdminRegisterController extends Controller
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
        return view('auth\adminregister')->with([
            'rolesList' => $roles_dropdown
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Model\Requests\Auth\AdminRegisterPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AdminRegisterPostRequest $request)
    {
        event(new Registered($admin = $this->create($request->validatedIntoCollection())));
        
        return $this->registered($request, $admin)
                        ?: redirect($this->redirectPath());
    }
    protected function create(Collection $data)
    {
        return $this->authService->RegisterAdmin($data);
    }
}
