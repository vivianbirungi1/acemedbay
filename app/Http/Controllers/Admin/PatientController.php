<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient; //using the Patient model
use App\Models\User; //using the User model
use Hash;
use App\Models\MedicalInsurance; //using Medical insurance model

class PatientController extends Controller
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
    public function index() //index method displaying all patients
    {
      $patients = Patient::all(); //calling all patients using the patients model

      return view('admin.patients.index', [
        'patients' => $patients
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //create method for patients. displays the patients form
    {

        $users = User::all();
        $medical_insurances = MedicalInsurance::all(); //also calling all medical insurance companies to add to new patient

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
    public function store(Request $request)  //store method, validating th form from the create method.
    {

      $patient = new Patient();

      $request ->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|between:3,191|email|unique:users,email' . $patient->user_id,
        'medical_insurance_id' => 'required',
        'policy_number' => 'required|integer|min:4',
        'user_id' => 'required|numeric|min:0'
      ]);

      //creating a new User with user information and adding a nre patient in with the patient information
      $user = new User();
      $user->name = $request->input('name');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->email = $request->input('email');
      $user->password = Hash::make('secret');
      $user->save();


      $patient->policy_number = $request->input('policy_number');
      $patient->user_id = $user->id;
      $patient->medical_insurance_id = $request->input('medical_insurance_id');
      $patient->save(); //save method to save the above information entered in the form

      $request->session()->flash('success', 'Patient added successfully'); //flash message to show a patient has been added successfully once new user is created and form submitted

      return redirect()->route('admin.patients.index'); //redirects the admin back to the index.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //show method to display on page when a single patient is clicked.
    {
      $patient = Patient::findOrFail($id); //displaying single patient by ID

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
    public function edit($id)  ///edit method displays the edit form.
    {
      $patient = Patient::findOrFail($id); //editing a single  patient by ID
      $medical_insurances = MedicalInsurance::all(); //shows all medical insurance in case there needs to be a change made

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
    public function update(Request $request, $id) //update method, validates the form filled in from the edit. Requests the ID of the patient being edited and validates the fields
    {

      $patient = Patient::findOrFail($id);

      $request ->validate([
        'name' => 'required|max:191',
        'address' => 'required|max:191',
        'phone' => 'required|size:10',
        'email' => 'required|between:3,191|email|unique:users,email,' . $patient->user_id, // //passing in this specific patients user ID to show we are not submitting a duplicate entry of the email of the same patient but rather updating it
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

      $request->session()->flash('info', 'Patient edited successfully');  //displaying the flash message to say a patient has been edited successfully

      return redirect()->route('admin.patients.index'); //rerdirects admin to index after patient has been edited
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //destroy method to delete aspecific patient by ID.
    {
      $patient = Patient::findOrFail($id); //finding the patient by ID to delete them.
      $patient->delete();

      $request->session()->flash('danger', 'Patient deleted');  //displaying a flash message to say the patient has been deleted successfully.

      return redirect()->route('admin.patients.index'); //redirecting to the index page once patient has been deleted.
    }
}
