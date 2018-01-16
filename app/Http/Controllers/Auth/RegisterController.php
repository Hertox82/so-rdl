<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
        $data['birthdate'] = $data['year'].'-'.$data['month'].'-'.$data['day'];

        $data['comune_res'] = ucfirst(strtolower($data['comune_res']));

        $validator = [
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'comune_nasc' => 'required|string',
            'cod_fisc'  => 'required|string|max:16',
            'phone' => 'required',
            'comune_res' => 'required|string',
            'prov_res'  => 'required|string|max:2',
            'ind_res'   => 'required',
            'cap'       => 'required|max:5',
            'sez'       => 'required'];

        if($data['comune_res'] == 'Roma') {
            $validator[] = ['mun_res' => 'required'];
        }

        return Validator::make($data, $validator);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        pr($data,1);
        $create = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'surname'   => $data['surname'],
            'birthdate' => $data['birthdate'],
            'comune_nasc' => $data['comune_nasc'],
            'cod_fisc' => $data['cod_fisc'],
            'phone' => $data['phone'],
            'comune_res' => $data['comune_res'],
            'prov_res' => $data['prov_res'],
            'ind_res' => $data['ind_res'],
            'cap' => $data['cap'],
            'livello' => $data['livello'],
            'sez' => $data['sez']
        ];

        if($data['comune_res'] == 'Roma') {
            $create[] = ['mun_res' => $data['mun_res']];
        }

        if(isset($data['note']) and strlen($data['note'])>0) {
            $create[] = ['note' => $data['note']];
        }

        return User::create($create);
    }
}
