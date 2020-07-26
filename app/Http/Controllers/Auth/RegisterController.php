<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/complete';

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
        return Validator::make($data, [
            'login_id' => 'required|string|max:255|regex:/^[a-zA-Z0-9]+$/|unique:accounts',
            'password' => 'required|string|between:8,12|regex:/^[a-zA-Z0-9]+$/',
            'nickname' => 'required|max:12',
        ],
        [
            'login_id.regex' => '半角英数字のみで入力してください。',
            'password.regex' => '半角英数字のみで入力してください。'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Account
     */
    protected function create(array $data)
    {
        return Account::create([
            'login_id' => $data['login_id'],
            'password' => Hash::make($data['password']),
            'nickname' => $data['nickname'],
        ]);
    }

    public function confirmForm(Request $request, $parm)
    {
        return view('auth.confirm', $parm);
    }

    public function confirm(Request $request)
    {
        $this->validator($request->all())->validate();
        $parm = [
            'login_id' => $request->input('login_id'),
            'password' => $request->input('password'),
            'nickname' => $request->input('nickname'),
        ];
        return $this->confirmForm($request, $parm);
    }
}
