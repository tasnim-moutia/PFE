<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Echange;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request){
        $userID = $request->user()->id;
        $notifications = Notification::with('echange', 'toUser')->where('toUser_id', $userID )->get();
        return view('notification', compact('notifications'));
    }
    public function destroy($id)
    { 
        $notifications=Notification::find($id);
        $notifications->delete();
        return response()->json(['message'=>'Demande déchange supprimée ']);
    }
}
