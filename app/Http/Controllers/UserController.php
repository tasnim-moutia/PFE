<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Categorie;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $annonces = Annonce::with('categorie', 'user')->get();
        return view('home', compact('annonces'));  
        /*return view('home');*/
    }
    function profil(){
        $user = DB::table('users')->get();
        return view('dashboards.users.profil', compact('user'));
    }

    /*modifier profil*/
    public function edit($id)
    {
       $user = DB::table('users')->where('id', $id)->first();
        return view ('dashboards/users/edit-profil', compact('user'));
    }

    public function update(Request $request)
    {
        
        $user = DB::table('users')->where('id', $request->id)->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'num_telephone' => $request->num_telephone 
                
            ]);
            return back()->with('success', 'Profil modifié');
    }

    /*Gestion Admin*/
    public function list(){
        $users = DB::table('users')->where('role', '2')->get();
        return view('dashboards/admins/users/users-list', compact('users'));
    }
    
    public function valid($id){
        $users = User::where('id', '=', e($id))->first();
        if ($users) {
            $users->valide = 1;
            $users->save();
            return redirect()->back()->with('success', 'utilisateur valider');
        }
    }

   /* public function delete($id)
    {
        $users= DB::table('users')->where('id', $id)->delete();  
        return back()->with('success', 'Compte supprimé'); 
    }*/
    public function delete($id)
    { 
        $users=User::find($id);
        $users->delete();
        return response()->json(['message'=>'Utilisateur supprimé']);
    }
}
