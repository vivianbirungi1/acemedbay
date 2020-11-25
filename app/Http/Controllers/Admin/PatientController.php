<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

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
        return view('admin.patients.create');
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
        'policy_number' => 'required|string|max:199',
        'insurance_company' => 'required|string|max:199',
        'user_id' => 'required|numeric|min:0'
        // 'user_id' => 'required|exists:users,id'
      ]);

      $patient = new Patient();

      $patient->policy_number = $request->input('policy_number');
      $patient->insurance_company = $request->input('insurance_company');
      $patient->user_id = $request->input('user_id');
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

       return view('admin.patients.edit', [
         'patient' => $patient
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
        'policy_number' => 'required|string|max:199',
        'insurance_company' => 'required|string|max:199',
        'user_id' => 'required|numeric|min:0'
        // 'user_id' => 'required|exists:users,id'
      ]);

      $patient = Patient::findOrFail($id);

      $patient->policy_number = $request->input('policy_number');
      $patient->insurance_company = $request->input('insurance_company');
      $patient->user_id = $request->input('user_id');
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
