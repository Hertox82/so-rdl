<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\LController as Controller;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Auth\Events\Registered;

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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect(route('verifyEmail'));

    }

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
        $data['comune_res'] = ucfirst(strtolower($data['comune_res']));

        $validator = [
            'name'          => 'required|string|max:255',
            'surname'       => 'required',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'comune_nasc'   => 'required|string',
            'cod_fisc'      => 'required|string|max:16',
            'phone'         => 'required',
            'comune_res'    => 'required|string',
            'prov_res'      => 'required|string|max:2',
            'ind_res'       => 'required',
            'cap'           => 'required|max:5'
        ];

        if($data['comune_res'] == 'Roma') {
            $validator['mun_res'] =  'required';
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
        $data['birthdate'] = $data['year'].'-'.$data['month'].'-'.$data['day'];
        $data['comune_res'] = ucfirst(strtolower($data['comune_res']));
        $data['prov_res'] = strtoupper($data['prov_res']);
        $data['cod_fisc'] = strtoupper($data['cod_fisc']);

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
            'verifyToken' => base64_encode($data['email'])
        ];


        if($data['comune_res'] == 'Roma') {
            $create[] = ['mun_res' => $data['mun_res']];
        }

        if(isset($data['note']) and strlen($data['note'])>0) {
            $create[] = ['note' => $data['note']];
        }

        if(isset($data['sez']) and strlen($data['sez'])>0) {
            $create[] = ['sez' => $data['sez']];
        }

        $user = User::create($create);
        DB::table('users_roles')->insert([
            'idRole' => 4,
            'idUser' => $user->id
        ]);

        $dataUser = User::findOrFail($user->id);
        $this->sendMail($dataUser);

        return $user;

    }

    public function verification($token) {
        $user = User::where(['verifyToken' => $token, 'status' => 0])->first();

        if($user) {
            User::where(['verifyToken' => $token, 'status' => 0])->update(['verifyToken' => NULL, 'status' => 1]);
             return view('email.thanks');
        }
        else {
            return view('email.error');
        }
    }

    public function sendMail($dataUser) {

        Mail::to($dataUser['email'])->send(new VerifyEmail($dataUser));
    }

    public function verifyEmail(Request $request) {

        return view('email.verifyemail');

    }
}
