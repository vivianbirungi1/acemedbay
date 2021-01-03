<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Visit;
use Hash;

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
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|email|min:3|max:191',
        'start_date' => 'required|date',
        'user_id' => 'required|numeric|min:0'
      ]);

      $user = new User();
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();

      $doctor = new Doctor();
      $doctor->start_date = $request->input('start_date');
      $doctor->user_id = $request->input('user_id');
      $doctor->save();

      $request->session()->flash('success', 'Doctor added successfully');

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
      $visit = Visit::all();

       return view('admin.doctors.show', [
         'doctor' => $doctor,
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
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|between:3,191|email|unique:users',
        'start_date' => 'required|date'
      ]);

      $user = User::findOrFail($id);
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();

      $doctor = Doctor::findOrFail($id);
      $doctor->start_date = $request->input('start_date');
      $doctor->user_id = $user->id;
      $doctor->save();

      $request->session()->flash('info', 'Doctor edited successfully');

      return redirect()->route('admin.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $doctor = Doctor::findOrFail($id);
      $doctor->delete();

      $request->session()->flash('danger', 'Doctor deleted');

      return redirect()->route('admin.doctors.index');
    }
}
