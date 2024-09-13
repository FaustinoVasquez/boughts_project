<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,softDeletes;

    protected $table = 'Account';
    protected $primaryKey = "Id";
    protected $appends = ['fullName'];
    protected $dates = ['deleted_at','HashDate'];

    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'email_verified_at' => 'datetime',
        'Deleted'=> 'bool',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname','email','username','profile','password','deleted'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];

    public function newEloquentBuilder($query)
    {
        return new UserQuery($query);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['Name'].' '.$this->attributes['LastName'];
    }


    public function setDeletedAttribute($value)
    {
        $delete = $this->attributes['deleted'] = $value =='inactive';
        $this->attributes['deleted_at'] = $delete ? Carbon::now() : null;
    }

    public function getDeletedAttribute()
    {
        if (isset($this->attributes['Deleted']))
        {
            return $this->attributes['Deleted'] ? 'inactive' : 'active';
        }
    }

    public function isAdmin()
    {
        return $this->Profile === 'Administrator';
    }

}
