<?php

namespace App\Models;
use App\Models\Annonce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = true;

    protected $fillable = [
        'nom_categorie'
    ];
    public function annonce(){
        return $this->hasMany(Annonce::class);
    }
}
