<?php

namespace App\Models;
use App\Models\User;
use App\Models\Echange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table="notifications";

    public function toUser(){
        return $this->belongsTo(User::class, 'toUser_id');
    }
    public function echange(){
        return $this->belongsTo(Echange::class);
    }

    protected $fillable = [
        'echange_id',
        'toUser_id ',
        'opened'
    ];
}
