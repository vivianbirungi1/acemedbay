<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Doctor;
use App\Models\Patient;

class VisitController extends Controller
{

  /**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('auth'); //only the authenticated user have access to the methods below. unauthenticated users will not have any access to these methods.
    $this->middleware('role:admin'); //can add more authorisation to view the page e.g admin
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //index method displays all visits
    {
      $visits = Visit::all();

      return view('admin.visits.index', [
        'visits' => $visits
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //create method, displays form for creating a visit
    {
        $doctors = Doctor::all(); //displays all doctors, patients and visits on the form
        $patients = Patient::all();
        $visits = Visit::all();
        return view('admin.visits.create', [
          'doctors' => $doctors,
          'patients' => $patients,
          'visits' => $visits
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //store method validates the create method form and stores and saves teh data in the database
    {
      $request ->validate([
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i',
        'duration' => 'required',
        'cost' => 'required|numeric|min:0',
        'doctor_id' => 'required|exists:doctors,id',
        'patient_id' => 'required|exists:patients,id'
      ]);

      $visit = new Visit(); //creating a new visit and expecting these entries in each field

      $visit->date = $request->input('date');
      $visit->start_time = $request->input('start_time');
      $visit->end_time = $request->input('end_time');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = $request->input('doctor_id');
      $visit->patient_id = $request->input('patient_id');
      $visit->save();

      $request->session()->flash('success', 'Visit added successfully'); //displays a flash message once visit has been added succesfully

      return redirect()->route('admin.visits.index'); //redirects amdin to visits index
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //show one visit by ID
    {
      $visit = Visit::findOrFail($id);

       return view('admin.visits.show', [
         'visit' => $visit
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //editing one visit by ID, diaplys edit form for one visit.
    {
      $visit = Visit::findOrFail($id);
      $doctors = Doctor::all(); ///display all doctors and patients on edit form
      $patients = Patient::all();

       return view('admin.visits.edit', [
         'visit' => $visit,
         'doctors' => $doctors,
         'patients' => $patients
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //update method executes on form edit form is submitted. validates all fields in the form
    {
      $request ->validate([
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i:s',
        'end_time' => 'required|date_format:H:i:s',
        'duration' => 'required',
        'cost' => 'required|numeric|min:0',
        'doctor_id' => 'required|exists:doctors,id',
        'patient_id' => 'required|exists:patients,id'
      ]);

      $visit = Visit::findOrFail($id);

      $visit->date = $request->input('date');
      $visit->start_time = $request->input('start_time');
      $visit->end_time = $request->input('end_time');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = $request->input('doctor_id');
      $visit->patient_id = $request->input('patient_id');
      $visit->save();

      $request->session()->flash('info', 'Visit edited successfully'); //displays flash message to say visit edited successfully

      return redirect()->route('admin.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //delete method, finds one visit by ID and deletes this specific visit
    {
      $visit = Visit::findOrFail($id);

      $visit->delete();

      $request->session()->flash('danger', 'Visit deleted'); //displaying flash message when visit is deleted.

      return redirect()->route('admin.visits.index', $id); ///returing the admin to index
    }
}
