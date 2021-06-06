@extends('layouts.app')
@extends('layouts.script')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
       -webkit-appearance: none;
       margin: 0;
    }
    input[type="number"] {
       -moz-appearance: textfield;
    }
</style>
@section('content')
 <div class="container">
     <div class="row py-5">
         <div class="w-100">
             <h3 class="text-center">Ajouter une nouvelle annonce d'échange</h3>
         </div>
     </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
            @endif
        <form action="{{route('store.annonce')}}" class="action" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" name="titre" placeholder="titre de l'annonce" value="{{old ('titre')}}">
                <span class="text-danger">@error('titre') {{ $message }} @enderror</span>
            </div>
            
            <div class="form-group">
                <label for="selectcategory">choisir une catégorie</label>
                <br>
                <select class="form-control" name="categorie_id" id="categorie_id">
                    @foreach ($categories as $categorie)
                     <option value="{{$categorie->id}}">{{$categorie->nom_categorie}}</option>
                    @endforeach
                </select>
                <span class="text-danger">@error('selectcategory') {{ $message }} @enderror</span>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Description"  value="{{old ('description')}}">
                <span class="text-danger">@error('description') {{ $message }} @enderror</span>
            </div>

        
                <div class="input group mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" onchange="preview_image(event)">
                <img src="previewImg" alt="" id="output_image" style="width:130px;margin-top:10px" >
            <br><span class="text-danger">@error('image') {{ $message }} @enderror</span>
                </div>
            

            <div class="form-group">
                <label for="number">Valeur à la vente</label>
                <input type="number" class="form-control" name="estimation" placeholder="valeur estimer">
                <span class="text-danger">@error('estimation') {{ $message }} @enderror</span>
            </div>
             
            <div class="form-row" style="margin-left: 800px">
                <div class="form-group col-md-6">
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
                        <a href="{{route('annonce.list')}}" style="color: #ffff; text-decoration: none;">Annuler</a>
                    </button>
                </div>
                <div class="form-group col-md-6">
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" style="background-image:linear-gradient(to right, #e65540, #ecbc70)" type="submit">
                        Ajouter
                    </button>
               </div>
            </div>
        
        </form>
      

 </div>


 <script type='text/javascript'>
    function preview_image(event) 
    {
     var reader = new FileReader();
     reader.onload = function()
     {
      var output = document.getElementById('output_image');
      output.src = reader.result;
     }
     reader.readAsDataURL(event.target.files[0]);
    }
    </script>

@endsection