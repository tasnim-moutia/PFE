<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    

    public function annonnce(){
        
        $annonces=DB::table('annonces')->get();
        return view('home', compact('titre'));
    }

    public function chat()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $this->data['users'] = $users;

        return view('chat', $this->data);
       
    }
}
