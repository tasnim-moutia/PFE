<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
class CategorieController extends Controller
{
    public function menu()
    {   
        $categories=DB::table('categories')->get();
        return view('home', compact('categories'));
        
    }

    public function show()
    {   
        $categories=DB::table('categories')->get();
        return view('catégories/categorie', compact('categories'));
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $categories = Categorie::latest()->paginate(5);

        return view('dashboards/admins/categories/index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);*/

            $categories = DB::table('categories')->get();
            return view('dashboards/admins/categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboards/admins/categories/create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     $rules = [
        'nom_categorie' => 'required|string|min:2|max:255|unique:categories',

    ];
    $messages = [
        'nom_categorie.required' => 'Vous veuillez écrire le nom de la nouvelle catégorie',
        'nom_categorie.unique' => 'Cette catégorie existe, veuillez saisir un autre nom',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);

      if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->all());
    }
        /*$request->validate([
            'nom_categorie' => 'required'
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créé avec succés.');*/

            $request->validate([
                'nom_categorie' => 'required|string|min:2|max:255|unique:categories'
            ]);
    
            $categories = new Categorie();
            $categories->nom_categorie = $request['nom_categorie'];
    
            $categories->save();
            return back()->with('success', 'Catégorie créé avec succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* return view('dashboards/admins/categories/edit', compact('categorie'));*/
       $categories = DB::table('categories')->where('id', $id)->first();
        return view ('dashboards/admins/categories/edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {    $rules = [
        'nom_categorie' => 'required|string|min:2|max:255|unique:categories',

    ];
    $messages = [
        'nom_categorie.required' => 'Vous veuillez écrire le nom de la nouvelle catégorie',
    ];
    $validator = Validator::make($request->all(),$rules,$messages);

      if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->all());
    }
        /*$request->validate([
            'nom_categorie' => 'required'
        ]);
        $categorie->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succés');*/

            $categories = DB::table('categories')->where('id', $request->id)->update([
                'nom_categorie' => $request->nom_categorie
                
            ]);
            return back()->with('success', 'Catégorie modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /* public function destroy($id)
    {
            /*$categories = Categorie::find($id);*/
           /* DB::table('categories')->where('id', $id)->delete();
            return back()->with('success', 'Catégorie supprimée avec succés');*/

       /* $categories= DB::table('categories')->where('id', $id)->delete();  
        return back()->with('success', 'Catégorie supprimée avec succés'); 
    }*/
    public function destroy($id)
    { 
        $categories=Categorie::find($id);
        $categories->delete();
        return response()->json(['message'=>'Catégorie supprimée ']);
    }

}
