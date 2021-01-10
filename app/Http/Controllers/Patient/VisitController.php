<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit; //using visit and patient mdoel
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
    $this->middleware('role:patient'); //the user role authorised to see the page. can add more authorisation to view the page e.g patient
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //index method displays visits on page
    {
      $user = Auth::user(); //checking for the authorised user
      $visits = $user->patient->visits()->orderBy('date', 'asc')->paginate(8); //displatying only visits relevant to authorised patient viewing the page

       //$visits =  Visit::all();
       $patient = Patient::all();

      return view('patient.visits.index', [
        'visits' => $visits,
        'patient' => $patient
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //show method displays the form for the single visit by ID
    {
      $visit = Visit::findOrFail($id);
      $patient = Patient::all();

       return view('patient.visits.show', [
         'visit' => $visit,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //destroy method, deletes single visit by ID
    {
      $visit = Visit::findOrFail($id);
      $visit->delete();

      $request->session()->flash('danger', 'Patient visit cencelled'); //displays flash message to say visit has been cancelled.

      return redirect()->route('patient.visits.index', $id);
    }
}
