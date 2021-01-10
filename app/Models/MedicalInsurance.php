<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInsurance extends Model
{
    use HasFactory;

    public function patient()
    {
      return $this->hasMany('App\Models\Patient', 'patient_id'); //a medical insurance comapny has many patients. passing in the pateint id because medinsurance is a foreign key on the patients table.
    }
}
