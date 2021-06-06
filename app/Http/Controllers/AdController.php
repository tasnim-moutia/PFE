<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Ad;
use App\Models\User;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    /*Home*/
    public function carosel(){
        $ads = Ad::with('user', 'annonce')->get();
        return view('welcome', compact('ads'));
       /*$ads = Ad::get();
        return view('home')->with('ads', $ads);*/
    
    }

    public function create(Request $request){
        $userID = $request->user()->id;
        $annonces=Annonce::get()->where('user_id', $userID );
        return view('annonce/lancer-ad')->with('annonces', $annonces);
    }

    public function store(Request $request){
        $rules = [
            'img' => 'required|file',
            'prix' => 'required'
    
        ];
        $message = [
            'img.required' => 'Vous veuillez ajouter l\'image de votre produit',
            'prix.required' => 'Vous veuillez écrire le prix à payer pour cette publicité ',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
    
          if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
          }               
        $image = null;
        if($request->hasFile('img')){
            $image = $request->file('img')->getClientOriginalName();
            $request->img->storeAs('ads', $image, 'public');
        }
          
        $user = auth()->user();
        $ads = new Ad();
        $ads->user_id = $user->id;
        $ads->annonce_id = $request->annonce_id;
        $ads->img = $image;
        $ads->prix = $request->prix;

        $ads->save();
        return back()->with('success', 'Vous recevrez notre réponse dans 3 jours');

    }

    /*Admin*/ 
    public function list(){
        $ads = Ad::with('user', 'annonce')->get();
        /*$ads = DB::table('ads')->get();*/
        return view('dashboards/admins/ads/list-ads', compact('ads'));
        /*$ads = Ad::with('annonce', 'user')->get();
        return view('dashboards/admins/ads/list-ads', compact('ads'));*/
    }

    public function details($id){
        $ads = Ad::findOrFail($id);
        $user=User::get();
        $annonces = Annonce::all();
        $ads = Ad::with('annonce', 'user')->where('id', $id)->first();
        return view ('dashboards/admins/ads/détails-annonce', compact('ads', 'user','annonces'));
       
    }

    public function confirm($id){
        $ads = Ad::where('id', '=', e($id))->first();
        if ($ads) {
            $ads->confirmer = 1;
            $ads->save();
            return redirect()->back();
        }
    }

    public function destroy($id)
    { 
        $ads=Ad::find($id);
        $ads->delete();
        return response()->json(['message'=>'Demande supprimée ']);
    }
}
