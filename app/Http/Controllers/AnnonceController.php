<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{
    public function recherche(Request $request){
        $request->validate([
            'query' => 'required|min:2'
        ]);
        $query = $request->input('query');
        $annonces = Annonce::where('titre', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('estimation', 'LIKE', "%{$query}%")
                  ->paginate(2);
        return view('recherche', compact('annonces'));

      /*  $search = $request->input('search');
        $annonces = Annonce::query()
        ->where('titre', 'LIKE', "%{$search}%")
        ->get();
        return view('recherche', compact('annonces'));*/
    }
    
    public function annonce(){
        $annonces = Annonce::with('categorie', 'user')->get();
        return view('welcome', compact('annonces'));  
    }

    public function index1(){
        $annonces = Annonce::with('categorie', 'user')->get();
        return view('home', compact('annonces'));   
    }
    
    public function categorie(){
        $annonces = Annonce::with('categorie', 'user')->get();
        return view('home', compact('annonces'));   
    }

    public function show($id){
        $annonces = Annonce::findOrFail($id);
        $user=User::get();
        $categories = Categorie::all();
        $annonces = Annonce::with('categorie', 'user')->where('id', $id)->first();

        return view ('détails', compact('annonces', 'user', 'categories'));
    }

    public function index(Request $request){
        $userID = $request->user()->id;
        $annonces = Annonce::with('categorie', 'user')->where('user_id', $userID )->get();
        return view('annonce/index', compact('annonces'));
    }

    public function create(){
        $categories=Categorie::get();
        return view('annonce/publier')->with('categories', $categories);
    }

    public function store(Request $request){
        
        $rules = [
            'titre' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2|max:255',
            'image' => 'required',
            'estimation' => 'required'
    
        ];
        $messages = [
            'titre.required' => 'Vous veuillez écrire untitre pour votre annonce',
            'description.required' => 'Vous veuillez écrire une description pour votre annonce',
            'image.required' => 'Vous veuillez ajouter l\'image de votre produit',
            'estimation.required' => 'Vous veuillez écrire un montnat',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
    
          if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $img = null;
        if($request->hasFile('image')){
            $img = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('annonces', $img, 'public');
        }
          
        $user = auth()->user();
        $annonces = new Annonce();
        $annonces->user_id = $user->id;
        $annonces->titre = $request->titre;
        $annonces->categorie_id = $request->categorie_id;
        $annonces->description = $request->description;
        $annonces->image = $img;
        $annonces->estimation = $request->estimation;

        $annonces->save();
        return back()->with('success', 'Votre annonce a été ajoutée! Merci pour votre contribution :)');
    }
    
    public function edit($id){
        $annonces = Annonce::findOrFail($id);
        $user=User::get();
        $categories = Categorie::all();
        $annonces = DB::table('annonces')->where('id', $id)->first();
        return view ('annonce/modifier', compact('annonces', 'user', 'categories'));
        
    }

    public function update(Request $request, $id){

        $rules = [
            'titre' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2|max:255',
            'image' => 'required',
            'estimation' => 'required'
    
        ];
        $messages = [
            'titre.required' => 'Vous veuillez modifier le nom de l\'annonce',
            'description.required' => 'Vous veuillez modifier la description de l\'annonce',
            'image.required' => 'Vous veuillez ajouter l\'image de votre produit',
            'estimation.required' => 'Vous veuillez écrire un montnat',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
    
          if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
        
        $annonces = Annonce::findOrFail($id);
        $img = $annonces->image;
        if($request->hasFile('image')){
           /* if($img){
                Storage::delete('/storage/app/public/annonce/' . $img);
            }*/
            $img = $request->file('image')->getClientOriginalName();
            $request->image->storeAs('annonces', $img, 'public');
        }
        $annonces->update([
            'titre' => $request->titre,
            'categorie_id' => $request->categorie_id,
            'description' => $request->description,
            'image' => $img,
            'estimation' => $request->estimation

        ]);
        return back()->with('success', 'Votre annonce a été modifiée');
      
    }
    
    public function destroy($id)
    {
    	/*$annonces = Annonce::findOrFail($id);
        $annonces = DB::table('annonces')->where('id', $id)->delete();  
        return back()->with('success', 'Votre annonce a été supprimée');*/
        $annonces=Annonce::find($id);
        $annonces->delete();
        return response()->json(['message'=>'Annonce supprimée ']);
    }

    /*admin*/
    public function list(){
        $annonces = Annonce::with('categorie', 'user')->get();
        return view('dashboards/admins/annonces/list-annonces', compact('annonces'));
    }

    /*public function destroy($id)
    {
    	$annonces = Annonce::findOrFail($id);
        $annonces = DB::table('annonces')->where('id', $id)->delete();  
        return back()->with('success', 'Annonce supprimée');
    }*/

    public function modifier($id){
        $annonces = Annonce::findOrFail($id);
        $user=User::get();
        $categories = Categorie::all();
        $annonces = DB::table('annonces')->where('id', $id)->first();
        return view ('dashboards/admins/annonces/edit-annonces', compact('annonces', 'user', 'categories'));
        
    }

    public function updatee(Request $request, $id){
      
        $rules = [
            'titre' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2|max:255',
    
        ];
        $messages = [
            'titre.required' => 'Vous veuillez modifier le nom de l\'annonce',
            'description.required' => 'Vous veuillez modifier la description de l\'annonce',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
    
          if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
      
        $annonces = Annonce::findOrFail($id);
       
        $annonces->update([
            'titre' => $request->titre,
            'categorie_id' => $request->categorie_id,
            'description' => $request->description,
            

        ]);
        return back()->with('success', 'Annonce modifiée avec succès');
      
    }
    public function validatee($id){
        $annonces = Annonce::where('id', '=', e($id))->first();
        if ($annonces) {
            $annonces->valid = 1;
            $annonces->save();
            return redirect()->back()->with('success', 'Annonce validée avec succès');
        }
    }

    public function shows($id){
        $annonces = Annonce::findOrFail($id);
        $user=User::get();
        $categories = Categorie::all();
        $annonces = Annonce::with('categorie', 'user')->where('id', $id)->first();
        return view ('dashboards/admins/annonces/show-annonce', compact('annonces', 'user', 'categories'));
       
    }
    public function delete($id)
    {
    	/*$annonces = Annonce::findOrFail($id);
        $annonces = DB::table('annonces')->where('id', $id)->delete();  
        return back()->with('success', 'Votre annonce a été supprimée');*/
        $annonces=Annonce::find($id);
        $annonces->delete();
        return response()->json(['message'=>'Annonce supprimée ']);
    }

}
