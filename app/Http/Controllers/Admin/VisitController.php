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
    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admin.visits.create', [
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
    public function store(Request $request)
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

      $request->session()->flash('success', 'Visit added successfully');

      return redirect()->route('admin.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function edit($id)
    {
      $visit = Visit::findOrFail($id);
      $doctors = Doctor::all();
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
    public function update(Request $request, $id)
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

      $visit = Visit::findOrFail($id);

      $visit->date = $request->input('date');
      $visit->start_time = $request->input('start_time');
      $visit->end_time = $request->input('end_time');
      $visit->duration = $request->input('duration');
      $visit->cost = $request->input('cost');
      $visit->doctor_id = $request->input('doctor_id');
      $visit->patient_id = $request->input('patient_id');
      $visit->save();

      $request->session()->flash('info', 'Visit edited successfully');

      return redirect()->route('admin.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $rid)
    {
      $visit = Visit::findOrFail($rid);

      $visit->delete();

      $request->session()->flash('danger', 'Visit deleted');

      return redirect()->route('admin.visits.show', $id);
    }
}
