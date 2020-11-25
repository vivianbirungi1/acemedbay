<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
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
      $doctors = Doctor::all();

      return view('admin.doctors.index', [
        'doctors' => $doctors
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctors.create');
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
        'start_date' => 'required|date',
        'user_id' => 'required|numeric|min:0'
        // 'user_id' => 'required|exists:users,id'
      ]);

      $doctor = new Doctor();

      $doctor->start_date = $request->input('start_date');
      $doctor->user_id = $request->input('user_id');
      $doctor->save();

      return redirect()->route('admin.doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $doctor = Doctor::findOrFail($id);

       return view('admin.doctors.show', [
         'doctor' => $doctor
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
      $doctor = Doctor::findOrFail($id);

       return view('admin.doctors.edit', [
         'doctor' => $doctor
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
        'start_date' => 'required|date',
        'user_id' => 'required|numeric|min:0'
        // 'user_id' => 'required|exists:users,id'
      ]);

      $doctor = Doctor::findOrFail($id);

      $doctor->start_date = $request->input('start_date');
      $doctor->user_id = $request->input('user_id');
      $doctor->save();

      return redirect()->route('admin.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $doctor = Doctor::findOrFail($id);
      $doctor->delete();

      return redirect()->route('admin.doctors.index');
    }
}
