<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function visits()
    {
      return $this->hasMany('App\Models\Visit');
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function medical_insurance()
    {
      return $this->belongsTo('App\Models\MedicalInsurance', 'medical_insurance_id');
    }
}
