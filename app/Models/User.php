<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ //for fields in the user table.
        'name',
        'address',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function visits()
    {
      return $this->hasMany('App\Models\Visit', 'user_id'); //a user has many visits.
    }

    public function roles()
    {
      return $this->belongsToMany('App\Models\Role', 'user_role'); //a user belongs to many roles, i.e doctors, patients, users
    }

    public function doctor()
    {
      return $this->hasOne('App\Models\Doctor'); //a user has one doctor
    }

    public function patient()
    {
      return $this->hasOne('App\Models\Patient'); //a user has one patient
    }


    public function authorizeRoles($roles)
  {
    if (is_array($roles)) {
      return $this->hasAnyRole($roles); //short circuit syntax
    }
    return $this->hasRole($roles);
  }

  public function hasAnyRole($roles) //for checking list of roles
  {
    return null !== $this->roles()->whereIn('name', $roles)->first();
  }

  public function hasRole($role) //for checking one specific role
  {
    return null !== $this->roles()->where('name', $role)->first();
  }
}
