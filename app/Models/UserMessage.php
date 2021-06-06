<?php

namespace App\Models;
use App\Models\Message;
use App\Models\Echange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;
    protected $table="user_messages";
   
    public function message() { 
        return $this->belongsTo(Message::class);
    }

    public function echange() {
        return $this->belongsTo(Echange::class, 'receiver_id');
    }
}
