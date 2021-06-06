<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index(){
        return view('dashboards.admins.index');
    }
    function profil(){
        $users=DB::table('users')->get();
        return view('dashboards.admins.profil', compact('users'));
    }
    function settings(){
        return view('dashboards.admins.settings');
    }

    public function edit($id)
    {   
        $users = DB::table('users')->first();
        return view ('dashboards/admins/edit-profil', compact('users'))->with('users', $users);
    }

    public function update(Request $request)
    {
        
        $users= DB::table('users')->where('id', $request->id)->update([
                'nom' => $request->nom,
                'email' => $request->email,
                'num_telephone' => $request->num_telephone 

                
            ]);
            return back()->with('success', 'Votre profil a été modifier');
    }
}
