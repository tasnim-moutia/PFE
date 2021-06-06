<?php

namespace App\Models;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Notification;
use App\Models\UserMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echange extends Model
{
    use HasFactory;
    protected $table="echanges";

    public function annonce(){
        return $this->belongsTo(Annonce::class);
    }
    public function sentBy(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function toUser(){
        return $this->belongsTo(User::class, 'toUser_id');
    }

    public function notification(){
        return $this->hasMany(Notification::class);
    }

    public function user_messages(){
        return $this->hasMany(UserMessage::class);
    }

    protected $fillable = [
        'user_id',
        'sentTo_id ',
        'annonce_id',
        'en_echange',
        'description',
        'image',
        'montant_supplémentaire'
    ];
}
