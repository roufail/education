<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:students');
        $this->redirectTo = route('student.profile');
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
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'mobile'        => ['required', 'string', 'max:255','unique:students'],
            'birthday'      => ['required', 'date', 'max:255'],
            'country'       => ['required', 'string', 'max:255'],
            'state'         => ['required', 'string', 'max:255'],
            'job'           => ['required', 'string', 'max:255'],
            'church'        => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'password'      => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Student::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'mobile'        => $data['mobile'],
            'birthday'      => $data['birthday'],
            'country'       => $data['country'],
            'state'         => $data['state'],
            'job'           => $data['job'],
            'church'        => $data['church'],
            'qualification' => $data['qualification'],
            'password'      => Hash::make($data['password']),
        ]);
    }


    public function showRegistrationForm()
    {
        return view('student.auth.register');
    }

    protected function guard()
    {
        return Auth::guard('students');
    }
}
