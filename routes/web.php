<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

use App\Http\Controllers\Doctor\HomeController as DoctorHomeController;
use App\Http\Controllers\Patient\HomeController as PatientHomeController;

use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;

use App\Http\Controllers\Doctor\VisitController as DoctorVisitController;
use App\Http\Controllers\Patient\VisitController as PatientVisitController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/about', [PageController::class, 'about'])->name('about');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin.home');
Route::get('/user/home', [UserHomeController::class, 'index'])->name('user.home');

Route::get('/doctor/home', [DoctorHomeController::class, 'index'])->name('doctor.home');
Route::get('/patient/home', [PatientHomeController::class, 'index'])->name('patient.home');


//CRUD FOR VISITS IN ADMIN
Route::get('/admin/visits', [AdminVisitController::class, 'index'])->name('admin.visits.index');
Route::get('/admin/visits/create', [AdminVisitController::class, 'create'])->name('admin.visits.create');
Route::get('/admin/visits/{id}', [AdminVisitController::class, 'show'])->name('admin.visits.show');
Route::post('/admin/visits/store', [AdminVisitController::class, 'store'])->name('admin.visits.store');
Route::get('/admin/visits/{id}/edit', [AdminVisitController::class, 'edit'])->name('admin.visits.edit');
Route::put('/admin/visits/{id}', [AdminVisitController::class, 'update'])->name('admin.visits.update');
Route::delete('/admin/visits/{id}', [AdminVisitController::class, 'destroy'])->name('admin.visits.destroy');

//CRUD FOR DOCTORS IN ADMIN
Route::get('/admin/doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/admin/doctors/create', [AdminDoctorController::class, 'create'])->name('admin.doctors.create');
Route::get('/admin/doctors/{id}', [AdminDoctorController::class, 'show'])->name('admin.doctors.show');
Route::post('/admin/doctors/store', [AdminDoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/admin/doctors/{id}/edit', [AdminDoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/admin/doctors/{id}', [AdminDoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/admin/doctors/{id}', [AdminDoctorController::class, 'destroy'])->name('admin.doctors.destroy');

//CRUD FOR PATIENTS IN ADMIN
Route::get('/admin/patients', [AdminPatientController::class, 'index'])->name('admin.patients.index');
Route::get('/admin/patients/create', [AdminPatientController::class, 'create'])->name('admin.patients.create');
Route::get('/admin/patients/{id}', [AdminPatientController::class, 'show'])->name('admin.patients.show');
Route::post('/admin/patients/store', [AdminPatientController::class, 'store'])->name('admin.patients.store');
Route::get('/admin/patients/{id}/edit', [AdminPatientController::class, 'edit'])->name('admin.patients.edit');
Route::put('/admin/patients/{id}', [AdminPatientController::class, 'update'])->name('admin.patients.update');
Route::delete('/admin/patients/{id}', [AdminPatientController::class, 'destroy'])->name('admin.patients.destroy');

//CRUD FOR VISITS IN DOCTOR
Route::get('/doctor/visits', [DoctorVisitController::class, 'index'])->name('doctor.visits.index');
Route::get('/doctor/visits/create', [DoctorVisitController::class, 'create'])->name('doctor.visits.create');
Route::get('/doctor/visits/{id}', [DoctorVisitController::class, 'show'])->name('doctor.visits.show');
Route::post('/doctor/visits/store', [DoctorVisitController::class, 'store'])->name('doctor.visits.store');
Route::get('/doctor/visits/{id}/edit', [DoctorVisitController::class, 'edit'])->name('doctor.visits.edit');
Route::put('/doctor/visits/{id}', [DoctorVisitController::class, 'update'])->name('doctor.visits.update');
Route::delete('/doctor/visits/{id}', [DoctorVisitController::class, 'destroy'])->name('doctor.visits.destroy');

//VIEW, SHOW AND DELETE FOR PATIENT
Route::get('/patient/visits', [PatientVisitController::class, 'index'])->name('patient.visits.index');
Route::get('/patient/visits/{id}', [PatientVisitController::class, 'show'])->name('patient.visits.show');
Route::delete('/patient/visits/{id}', [PatientVisitController::class, 'destroy'])->name('patient.visits.destroy');

//for visits under patients in admin
Route::get('/admin/patients/{id}/visits/create', [AdminVisitController::class, 'create'])->name('patient.visits.create');
Route::post('/admin/patients/{id}/visits/store', [AdminVisitController::class, 'store'])->name('patient.visits.store');
//Route::delete('/admin/patients/{id}/visits/{rid}', [AdminVisitController::class, 'destroy'])->name('patient.visits.destroy');

//for visits under doctors in admin
Route::get('/admin/doctors/{id}/visits/create', [AdminVisitController::class, 'create'])->name('admin.visits.create');
Route::post('/admin/doctors/{id}/visits/store', [AdminVisitController::class, 'store'])->name('admin.visits.store');
//Route::delete('/admin/doctors/{id}/visits/{rid}', [AdminVisitController::class, 'destroy'])->name('doctor.visits.destroy');
