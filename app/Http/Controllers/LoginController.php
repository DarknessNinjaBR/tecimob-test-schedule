<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->only([
            'email',
            'password',
        ]);
        $validator = $this->validator($data);

        $remember = $request->input('remember', false);

        if($validator->fails()){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt($data, $remember)){
            return redirect()->route('home');
        }else{
            $validator->errors()->add('password','Email e/ou senha inválidos');
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:5']
        ]);
    }
}
