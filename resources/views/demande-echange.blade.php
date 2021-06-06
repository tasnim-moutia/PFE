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
             <h3 class="text-center">Demande d'échange</h3>
         </div>
     </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
            @endif

        <form action="{{route('echange.store')}}" class="action" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <input type="hidden" id="annonce_id" name="annonce_id" value={{ $annonces->id }}>
            </div>
            
            <div class="form-group">
                <input type="hidden" id="sentTo_id" name="sentTo_id" value={{ $annonces->user_id }}>
            </div>

            <div class="form-group">
                <label for="text">En échange</label>
                <input type="text" class="form-control @error('en_echange') is-invalid @enderror" name="en_echange" value="{{ old('en_echange') }}"placeholder="produit en échange">
                @error('en_echange')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="text">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"placeholder="description">
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"  onchange="preview_image(event)" >
                <img src="previewImg" alt="" id="output_image" style="width:130px;margin-top:20px" >
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="number">Montant supplémentaire</label>
                <input type="number" class="form-control @error('montant_supplémentaire') is-invalid @enderror" name="montant_supplémentaire" value="{{ old('montant_supplémentaire') }}"placeholder="Montant supplémentaire">
                @error('montant_supplémentaire')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
             
            <div class="form-row" style="margin-left: 800px">
                <div class="form-group col-md-6">
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
                        <a href="{{route('annonce.show', $annonces->id)}}" style="color: #ffff; text-decoration: none;">Annuler</a>
                    </button>
                </div>
                <div class="form-group col-md-6">
                    <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" style="background-image:linear-gradient(to right, #e65540, #ecbc70)" type="submit">
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