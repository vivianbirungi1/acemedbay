<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //the users that belong at the role

    public function users()
    {
      return $this->belongsToMany('App\Models\User', 'user_role'); //a role belongs to many users.
    }
}
