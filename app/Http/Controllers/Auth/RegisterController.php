<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Team;
use App\Models\Unidade;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class RegisterController extends Controller
{
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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $regras =
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'matricula' => ['required', 'string', 'min:10', 'max:255', 'unique:users'],
                'campus' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'max:36', 'confirmed'],
            ];
        $msg = [
            'required' => "Este campo é obrigatório.",
            'max' => "O limite de caracteres foi excedido.",
            'email.unique' => "Já existe um usuário cadastrado com esse e-mail.",
            'matricula.unique' => "Já existe um usuário cadastrado com essa matrícula.",
            'password.min' => "Senha muito pequena.",
            'password.confirmed' => "As senhas não são iguais."
        ];
        return Validator::make($data, $regras, $msg);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        //Verifica se há usuário com mesmo e-mail ou mesma matrícula


        //Pega a sigla inserida automaticamente pelo SUAP e procura o ID correspondente. 
        //Importante cadastrar as siglas do mesmo jeito que está no SUAP. Ex.: MO, PF.
 
        $campus = Unidade::where('sigla', '=',$data['campus'])->get()->toArray();

 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'matricula' => $data['matricula'],
            'unidade_id' => $campus['0']['id'],
            'team_id'=>2
        ]);
        //Retorna o role usuário
        $role = Role::where('name', 'user')->pluck('id')->toArray();
        //Retorna a Team Usuário
        $team = Team::where('name', 'usuarios')->pluck('id')->first();
         //Atribui o role usuário (user) ao novo usuário
        
       $user->attachRole($role[0], $team);
      
       return $user;
    }
}
