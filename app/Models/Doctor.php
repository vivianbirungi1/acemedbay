<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function visits()
    {
      return $this->hasMany('App\Models\Visit', 'doctor_id'); //a doctor has many visits. also passing in the doctor id as it is a foreign key on the visits table
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User'); //a doctor belongs to the users table
    }
}
