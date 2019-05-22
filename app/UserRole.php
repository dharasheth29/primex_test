<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rolename',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // public function user()
    // {
    //     return $this->belongsTo('App\User', 'roleid');
    // }
}
