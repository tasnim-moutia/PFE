<?php

namespace App\Models;
use App\Models\User;
use App\Models\Annonce;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $table="ads";

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }

    protected $casts = [
        'prix' => 'float'
    ];

    protected $fillable = [
        'user_id',
        'annonce_id',
        'img',
        'prix',
        'confirmer'
    ];
}
