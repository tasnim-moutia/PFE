@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Détails de lannonce')
@section('content')
<div class="content-wrapper px-4 py-5 ml-1">
<div class=" col-md-8">
    <div class="card mb-3">
      <div class="card-body">
        <div class="media align-items-lg-center flex-column flex-lg-row p-2">
            <div class="media" style="margin-right: 40px"><img src="{{asset('storage/annonces/' . $ads->annonce->image ) }}" alt="image" height="170px" width= "140px" class="ml-lg-5 order-1 order-lg-2"></div>
              <div class="media-body">
                  
                  <h5 class="mt-0 font-weight-bold mb-2">{{$ads->annonce->titre}}</h5>
                  <h6 class="mt-0 font-italic mb-2">Créer le: {{date_format($ads->annonce->created_at, 'd-M-Y')}}</h6>
                  <h6 class="mt-0 font-italic mb-2">Publier par: {{$ads->user->nom}}</h6>
                  <br>
                  <p class="font-italic text-muted mb-0 small">{{$ads->annonce->description}}</p>
                  <br>
                  <div class="d-flex align-items-center justify-content-between mt-1">
                      <h6 class="font-weight-bold my-2">Valeur à la vente:  {{$ads->annonce->estimation}}TND</h6>
                  </div>
              </div>
        </div> 
    </div>
    </div>
</div>
</div>
@endsection