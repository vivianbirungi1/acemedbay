<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    public function doctor()
    {
      return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }

    public function patient()
    {
      return $this->belongsTo('App\Models\Patient', 'patient_id');
    }

    // public function user()
    // {
    //   return $this->belongsTo('App\Models\User');
    // }
}
