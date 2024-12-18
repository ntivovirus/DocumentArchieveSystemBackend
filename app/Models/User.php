<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes; // FOR SOFTDELETE 
use Illuminate\Contracts\Auth\CanResetPassword; // ADDED FOR PASSWORD RESET
// use Illuminate\Auth\Passwords\CanResetPassword; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // START PERSONAL FUNCTIONS



    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    

    // END PERSONAL FUNCTIONS

}
