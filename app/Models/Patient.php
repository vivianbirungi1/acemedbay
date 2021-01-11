<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [ //for fields in the user table.
        'user_id',
    ];

    public function visits()
    {
      return $this->hasMany('App\Models\Visit', 'patient_id'); //a patient has many visits. passing in the patient id as it is a foreign key on the visits table.
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User'); //a patient belongs to a user
    }

    public function medical_insurance()
    {
      return $this->belongsTo('App\Models\MedicalInsurance', 'medical_insurance_id'); //a patient belongs to a medical insurance company. passing in the medinsurance is as it is a foreign key on the patients table.
    }
}
