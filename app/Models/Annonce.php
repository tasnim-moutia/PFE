<?php

namespace App\Models;
use App\Models\Ad;
use App\Models\User;
use App\Models\Echange;
use App\Models\Categorie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $table="annonces";

    protected $fillable = [
        'user_id',
        'titre',
        'categorie_id',
        'image',
        'description',
        'estimation',
        'created_at'
    ];

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ad(){
        return $this->hasOne(Ad::class);
    }

    public function echange(){
        return $this->hasMany(Echange::class);
    }
}
