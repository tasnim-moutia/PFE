<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class AvisController extends Controller
{  
    public function ajouterAvis(){
        return view('ajouter-avis');
    }
    public function saveAvis(Request $request){

        $rules = [
            'nom' => 'required|string|max:20',
            'message' => 'required|string|max:255'
    
        ];
        $message = [
            'nom.required' => 'Vous veuillez écrire votre nom',
            'message.required' => 'Vous veuillez écrire un message',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
    
          if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $avis = new Avis();
        $avis->nom = $request['nom'];
        $avis->message = $request['message'];

        $avis->save();
        return back()->with('avis_ajouté', 'Merci pour votre contribution');
    }

    public function avisList(){
            $avis = DB::table('Avis')->get();
            return view('dashboards/admins/avis/avis-list', compact('avis'));
    }
    public function editAvis($id){
        $avis = DB::table('Avis')->where('id', $id)->first();
        return view ('dashboards/admins/avis/edit-avis', compact('avis'));
    }

    public function updateAvis(Request $request){
        $avis = DB::table('Avis')->where('id', $request->id)->update([
            'nom' => $request->nom,
            'message' => $request->message
        ]);
        return back()->with('avis_modifié', 'Votre avis a été modifié');
    }
    /*public function deleteAvis($id){
        $avis = DB::table('Avis')->where('id', $id)->delete();  
        return back()->with('avis_supprimé', 'Avis supprimé');    
    }*/
    public function destroy($id)
    { 
        $avis=Avis::find($id);
        $avis->delete();
        return response()->json(['message'=>'Avis supprimée ']);
    }

    public function contact()
    {
        return view('contact');
    }

}
