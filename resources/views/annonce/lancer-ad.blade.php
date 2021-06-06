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
             <h3 class="text-center">Lancer une demande de publicité pour votre annonce</h3>
         </div>
     </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
            @endif
        <form action="{{route('store.ad')}}" class="action" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <label for="selectannonce">Choisir une annonce</label>
                <br>
                <select class="form-control" name="annonce_id" id="annonce_id">
                    @foreach ($annonces as $annonce)
                    <option value="{{$annonce->id}}">{{$annonce->titre}}</option>
                    @endforeach
                </select>
                <span class="text-danger">@error('selectannonce') {{ $message }} @enderror</span>
            </div>

            <div class="input group mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="img" name="img" onchange="preview_image(event)">
                <img src="previewImg" alt="image doit être 1920x570" id="output_image" style="width:130px;margin-top:10px" >
                <br><span class="text-danger">@error('img') {{ $message }} @enderror</span>
            </div>
            

            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="number" class="form-control" name="prix" placeholder="Le prix payé doit être 5% de l'estimation de valeur du produit de l'annonce">
                <span class="text-danger">@error('prix') {{ $message }} @enderror</span>
            </div>
             
            <div class="form-row" style="margin-left: 800px">
                <div class="form-group col-md-6">
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4"  type="submit">
                        <a href="{{route('annonce.list')}}" style="color: #ffff; text-decoration: none;">Annuler</a>
                    </button>
                </div>
                <div class="form-group col-md-6">
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" style="background-image:linear-gradient(to right, #e65540, #ecbc70)"type="submit">
                        Envoyer
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