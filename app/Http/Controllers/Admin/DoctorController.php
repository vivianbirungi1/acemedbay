<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor; //passing in the Doctor model
use App\Models\User; //passing in the User model
use App\Models\Visit; //passing in the Visit model
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
    $this->middleware('auth'); //only the authenticated user have access to the methods below. unauthenticated users will not have any access to these methods.
    $this->middleware('role:admin'); //can add more authorisation to view the page e.g admin
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //index method displaying all doctors
    {
      $doctors = Doctor::all(); //calling all doctors using the Doctors model

      return view('admin.doctors.index', [
        'doctors' => $doctors
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //create method for doctors. displays the doctors form
    {
        return view('admin.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //store method, validating th form from the create method.
    {

      $doctor = new Doctor();

      $request ->validate([ //validation rules for creating a doctor
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|between:3,191|email|unique:users,email' .$doctor->user_id,
        'start_date' => 'required|date',
        'user_id' => 'required|numeric|min:0'
      ]);

      //creating a new User with user information and adding a nre doctor in with the doctor information
      $user = new User();
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();


      $doctor->start_date = $request->input('start_date');
      $doctor->user_id = $user->id;
      $doctor->save(); //save method to save the above information entered in the form

      $request->session()->flash('success', 'Doctor added successfully'); //flash message to show a doctor has been added successfully once new user is created and form submitted

      return redirect()->route('admin.doctors.index'); //redirects the admin back to the index.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //show method to display on page when a single doctor is clicked.
    {
      $doctor = Doctor::findOrFail($id); //displaying single doctor by ID
      $visit = Visit::all(); //also displaying all visits relating to this doctor underneath on the show page

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
    public function edit($id) ///edit method displays the edit form.
    {
      $doctor = Doctor::findOrFail($id); //editing a single  doctor by ID

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
    public function update(Request $request, $id) //update method, validates the form filled in from the edit. Requests the ID of the doctor being edited and validates the fields.
    {

      $doctor = Doctor::findOrFail($id);

      $request ->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|between:3,191|email|unique:users,email,' . $doctor->user_id, //passing in this specific doctors user ID to show we are not submitting a duplicate entry of the email of the same doctor but rather updating it
        'start_date' => 'required|date'
      ]);

      $user = User::findOrFail($doctor->user_id);
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();


      $doctor->start_date = $request->input('start_date');
      $doctor->save();

      $request->session()->flash('info', 'Doctor edited successfully'); //displaying the flash message to say a doctor has been edited successfully

      return redirect()->route('admin.doctors.index'); //rerdirects admin to index after doctor has been edited
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //destroy method to delete aspecific doctor by ID.
    {
      $doctor = Doctor::findOrFail($id); //finding the doctor by ID to delete them.
      $doctor->delete();

      $request->session()->flash('danger', 'Doctor deleted'); //displaying a flash message to say the docor has been deleted successfully.

      return redirect()->route('admin.doctors.index', $id); //redirecting to the index page once doctor has been deleted.
    }
}
