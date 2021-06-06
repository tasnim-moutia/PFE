<?php

namespace App\Models;
use App\Models\Ad;
use App\Models\Annonce;
use App\Models\Echange;
use App\Models\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table="users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'email',
        'num_telephone',
        'role',
        'password',
        'valide',
    ];
     public function annonce(){
        return $this->hasMany(Annonce::class);
    }

    public function ad(){
        return $this->hasMany(Ad::class);
    }

    public function echange(){
        return $this->hasMany(Echange::class);
    }

    public function notification(){
        return $this->hasMany(Notification::class);
    }

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
}
