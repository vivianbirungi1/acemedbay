<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInsurance extends Model
{
    use HasFactory;

    public function patient()
    {
      return $this->hasMany('App\Models\Patient');
    }
}
