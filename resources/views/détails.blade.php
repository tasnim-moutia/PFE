@extends('layouts.app')
@extends('layouts.script')
@section('content')
<div class="container" id="annonce-details">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
               
                <div class="card-body">

                    <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                        <div class="media" style="margin-right: 30px"><img src="{{asset('storage/annonces/' . $annonces->image ) }}" alt="image" height="170px" width= "140px" class="ml-lg-5 order-1 order-lg-2"></div>
                          <div class="media-body">
                              <h5 class="mt-0 font-weight-bold mb-2">{{$annonces->titre}}</h5>
                              <h6 class="mt-0 font-italic text-muted mb-2 small">Catégorie: {{$annonces->categorie->nom_categorie}}</h6>
                              <p class="font-italic text-muted mb-0 small">{{$annonces->description}}</p>
                              <div class="d-flex align-items-center justify-content-between mt-1">
                                  <h6 class="font-weight-bold my-2">Valeur à la vente:  {{$annonces->estimation}}TND</h6>
                              </div>
                              <div class="d-flex align-items pull-right">
                                 <ul class="list-inline small">
                                     <a class="btn effect01"  href="{{route('demande.echange', $annonces->id )}}" style="color: #ffff; text-decoration: none;background-color: #e65540; border-color:#e65540;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">Je veux</a></button>
                                  </ul>
                              </div>  
                          </div>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

