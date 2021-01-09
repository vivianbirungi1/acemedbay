<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use App\Models\Patient;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;  //protected property $redirectTo, used to specify the redirect URL when a user registers. by default users, are redirected to /home route but a different URL can be specified.

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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'address' => $data['address'],
        //     'phone' => $data['phone'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        //eveyrhting about the new user that will be logged when they are registering.  Uses the User model.
        $user = new User();
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
      //  $user->roles()->attach($role_patient);

      //want the user to be regiestered as a patient so we are using the Patient model and passing in some user informatiion that will be assigned to the every new patient.
      $patient = new Patient();
      $patient->medical_insurance_id = '1';
      $patient->policy_number = '29384';
      $patient->user_id = $user->id;
      $patient->save();

      $user->roles()->attach(Role::where('name', 'patient')->first());

        return $user;
    }
}
