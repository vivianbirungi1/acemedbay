<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
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

        $medical_insurances = MedicalInsurance::all();

        return view('admin.patients.create', [
          'medical_insurances' => $medical_insurances
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
        'user_id' => 'required|numeric|min:0',
        'password' => 'required|numeric|min:5'
      ]);

      $user = new User();
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->password);
      $user->save();

      $patient = new Patient();
      $patient->policy_number = $request->input('policy_number');
      $patient->user_id = $request->input('user_id');
      $patient->medical_insurance_id = $request->input('medical_insurance_id');
      $patient->save();

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
      $request ->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|email|min:3|max:191',
        'medical_insurance_id' => 'required',
        'policy_number' => 'required|integer|min:4',
        'user_id' => 'required|numeric|min:0',
        'password' => 'required|numeric|min:5'
      ]);

      $user = User::findOrFail($id);
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      // $user->password = $request->input('password');
      $user->password = Hash::make($request->password);
      $user->save();

      $patient = Patient::findOrFail($id);
      $patient->policy_number = $request->input('policy_number');
      $patient->user_id = $request->input('user_id');
      $patient->medical_insurance_id = $request->input('medical_insurance_id');
      $patient->save();

      return redirect()->route('admin.patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $patient = Patient::findOrFail($id);
      $patient->delete();

      return redirect()->route('admin.patients.index');
    }
}
