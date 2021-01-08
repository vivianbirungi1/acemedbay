<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Hash;
use App\Models\MedicalInsurance;

class PatientController extends Controller
{

  /**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('auth');
    $this->middleware('role:admin'); //can add more authorisation to view the page e.g admin
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $patients = Patient::all();

      return view('admin.patients.index', [
        'patients' => $patients
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        $medical_insurances = MedicalInsurance::all();

        return view('admin.patients.create', [
          'medical_insurances' => $medical_insurances,
          'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request ->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|email|min:3|max:191',
        'medical_insurance_id' => 'required',
        'policy_number' => 'required|integer|min:4',
        'user_id' => 'required|numeric|min:0'
      ]);

      $user = new User();
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();

      $patient = new Patient();
      $patient->policy_number = $request->input('policy_number');
      $patient->user_id = $request->input('user_id');
      $patient->medical_insurance_id = $request->input('medical_insurance_id');
      $patient->save();

      $request->session()->flash('success', 'Patient added successfully');

      return redirect()->route('admin.patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $patient = Patient::findOrFail($id);

       return view('admin.patients.show', [
         'patient' => $patient
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $patient = Patient::findOrFail($id);
      $medical_insurances = MedicalInsurance::all();

       return view('admin.patients.edit', [
         'patient' => $patient,
         'medical_insurances' => $medical_insurances
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $patient = Patient::findOrFail($id);

      $request ->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|between:3,191|email|unique:users,email,' . $patient->user_id, //
        'medical_insurance_id' => 'required',
        'policy_number' => 'required|integer|min:4'
      ]);

      $user = User::findOrFail($patient->user_id);
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();

      $patient->policy_number = $request->input('policy_number');
      $patient->medical_insurance_id = $request->input('medical_insurance_id');
      $patient->save();

      $request->session()->flash('info', 'Patient edited successfully');

      return redirect()->route('admin.patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $patient = Patient::findOrFail($id);
      $patient->delete();

      $request->session()->flash('danger', 'Patient deleted');

      return redirect()->route('admin.patients.index', $id);
    }
}
