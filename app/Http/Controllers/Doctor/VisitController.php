<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit; //using visit, patient, doctor models
use App\Models\Doctor;
use App\Models\Patient;
use Auth;

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
    $this->middleware('role:doctor'); //can add more authorisation to view the page e.g doctor
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //index displays visits for doctor
    {
      $user = Auth::user();
      $visits = $user->doctor->visits()->orderBy('date', 'asc')->paginate(8); //dislaying only visits specific to doctor viewing the page

      return view('doctor.visits.index', [
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
      $doctors = Doctor::all(); //form displays all doctors and patients
      $patients = Patient::all();
      return view('doctor.visits.create', [
        'doctors' => $doctors,
        'patients' => $patients
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //store method, validates form fields for new visit created
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

      $visit = new Visit();

      $visit->date = $request->input('date');
      $visit->start_time = $request->input('start_time');
      $visit->end_time = $request->input('end_time');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = $request->input('doctor_id');
      $visit->patient_id = $request->input('patient_id');
      $visit->save();

      $request->session()->flash('success', 'Doctor visit added successfully'); //flash message to let doctor know a visit was added successfully

      return redirect()->route('doctor.visits.index'); //redirects doctor to index page
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //show method, displays single visit by ID
    {
      $visit = Visit::findOrFail($id); //finding visit by ID to display

       return view('doctor.visits.show', [
         'visit' => $visit
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //edit method, displays form for editing a single visit. finds visit by ID
    {
      $visit = Visit::findOrFail($id);
      $doctors = Doctor::all();
      $patients = Patient::all();

       return view('doctor.visits.edit', [
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
    public function update(Request $request, $id) //update method is validating form of single edited visit
    {
      $request ->validate([
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i:s',
        'end_time' => 'required|date_format:H:i',
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

      $request->session()->flash('info', 'Doctor visit edited successfully');

      return redirect()->route('doctor.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //deleting a single visit by ID from the database.
    {
      $visit = Visit::findOrFail($id);
      $visit->delete();

      $request->session()->flash('danger', 'Doctor visit deleted'); //displaying flash message to say visit has been deleted.

      return redirect()->route('doctor.visits.index');
    }
}
