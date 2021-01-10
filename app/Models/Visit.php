<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    public function doctor()
    {
      return $this->belongsTo('App\Models\Doctor', 'doctor_id'); // a visit belongs to a doctor. doctor table uses user id a foreign key so we are passing in the doctor id here.
    }

    public function patient()
    {
      return $this->belongsTo('App\Models\Patient', 'patient_id'); //a visit belongs to a patient. patient table uses user id a foreign key so we are passing in the patient id here.
    }

    // public function user()
    // {
    //   return $this->belongsTo('App\Models\User');
    // }
}
