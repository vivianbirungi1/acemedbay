<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    public function doctor()
    {
      return $this->belongsTo('App\Models\Doctor');
    }

    public function patient()
    {
      return $this->belongsTo('App\Models\Patient');
    }

    // public function user()
    // {
    //   return $this->hasOne('App\Models\User');
    // }
}
