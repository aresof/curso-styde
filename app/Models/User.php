<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

/**
 * @property mixed email
 */
class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public function profession(){
       return $this->belongsTo(Profession::class);
       //return $this->belongTo(Profession::class, 'profession_id');
    }

    public function isAdmin(){
        return $this->email === 'arturo@arturo.es';
    }

    public static function findByEmail($email){
        return static::where(compact('email'))->first();
    }


}
