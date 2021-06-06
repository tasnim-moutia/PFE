<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Echange;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EchangeController extends Controller
{
    public function echange($id){
        $annonces = Annonce::findOrFail($id);
        $annonces = DB::table('annonces')->where('id', $id)->first();
        return view ('demande-echange', compact('annonces'));
    }

    
    public function store(Request $request)
    {   $rules = [
        'en_echange' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'image' => 'required|file',
        'montant_supplémentaire' => 'required'

    ];
    $messages = [
        'en_echange.required' => 'Vous veuillez écrire un produit en échange',
        'description.required' => 'Vous veuillez écrire une description pour votre produit',
        'image.required' => 'Vous veuillez ajouter l\'image de votre produit',
        'montant_supplémentaire.required' => 'Vous veuillez écrire un montnat ou 0 ',
       

    ];
    $validator = Validator::make($request->all(),$rules,$messages);

      if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->all());
    }
        
        $annnonces = DB::table('annonces')->first();
        $img = null;
        if($request->hasFile('image')){
            $img = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('echange', $img, 'public');
        }
        
        /*$user = auth()->user();
        $userID = $annnonces->user_id;
        $input = $request->all();
        $input['user_id'] = $request->user_id = $user;
        $input['sentTo_id'] = $request->sentTo_id = $userID;
        $input['image'] = $request->image = $img;
        $echanges = Echange::create($input);*/
        
        $user = auth()->user();
        $echanges = new Echange();
        $echanges->user_id = $user->id;
        $echanges->sentTo_id = $request->sentTo_id ;
        $echanges->annonce_id = $request->annonce_id;
        $echanges->en_echange = $request->en_echange;
        $echanges->description = $request->description;
        $echanges->image = $img;
        $echanges->montant_supplémentaire = $request->montant_supplémentaire;
        
        $echanges->save();

        $lastOne=DB::table('echanges')->orderBy('id','desc')->first();
        $notifications = new Notification();
        $notifications->echange_id = $lastOne->id;
        $notifications->toUser_id = $echanges->sentTo_id ;
        $notifications->save();
        return back()->with('success', 'Votre demande a été envoyée');

    }
}
