@extends('layouts.app')
@extends('layouts.script')
@section('content')
<div class="pull-right" style="margin-right: 50px; margin-top:10px"><a style="color: #e65540;" href="{{route('add.annonce')}}">  {{ __('Ajouter une annonce') }} </a></div>
<div class="pull-right" style="margin-right: 50px; margin-top:10px"><a style="color: #e65540;" href="{{route('create.ad')}}">  {{ __('Lancer une publicité') }} </a></div>
<div class="container py-5">
  <div class="col-lg-7 mx-auto">
</div>
  <div class="row">
      <div class="col-lg-10 mx-auto">
          <!-- List group-->
          @if ($annonces->count() > 0)
          <ul class="list-group shadow">
            @foreach ($annonces as $annonce)
              <!-- list group item-->
              <li class="list-group-item">
                  <!-- Custom content-->
                  <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                    <div class="media" style="margin-right: 30px"><img src="{{asset('storage/annonces/' . $annonce->image ) }}" alt="image" height="170px" width= "140px" class="ml-lg-5 order-1 order-lg-2"></div>
                      <div class="media-body">
                          <h5 class="mt-0 font-weight-bold mb-2">{{$annonce->titre}}</h5>
                          <h6 class="mt-0 font-italic text-muted mb-2 small">Catégorie: {{$annonce->categorie->nom_categorie}}</h6>
                          <p class="font-italic text-muted mb-0 small">{{$annonce->description}}</p>
                          <div class="d-flex align-items-center justify-content-between mt-1">
                              <h6 class="font-weight-bold my-2">{{$annonce->estimation}}TND</h6>
                          </div>
                          <div class="d-flex align-items" style="margin-left:350px">
                             <ul class="list-inline small" style="margin-right:50px">
                                 <a class="btn effect01"  href="{{route('edit.annonce', $annonce->id )}}" style="border-radius: 18px; border: none; background-image:linear-gradient(to right, #e65540, #ecbc70);
                                  padding: 8px; width: 100px; height: 40px;">Modifier</a></button>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 {{--<a class="btn effect01"  href="{{route('delete.annonce', $annonce->id )}}">Supprimer</a></button>--}}
                                  <a href="javascript:void(0)" onclick="deleteAnnonce({{ $annonce->id }})" class="btn" role="button"style="border-radius: 18px;
                                    border: 2px solid hsl(0, 100%, 50%);
                                    padding: 8px; width: 100px; height: 40px;" >Supprimer</a>
                              </ul>
                          </div>  
                      </div>
                  </div> <!-- End -->
              </li> <!-- End -->
              <!-- list group item-->
              @endforeach  
            </ul>  
              @else
                  <h2>Vous n'avez pas d'annonce</h2>
              @endif
           <!-- End -->
      </div>
  </div>
</div>      
@csrf
  <script>
      function deleteAnnonce(id)
      {
        if(confirm("Voullez-vous vraiment supprimer cette annonce ?"))
        {
         
          $.ajax({
            url: "/annonce/supprimer/"+id,
            type:'DELETE',
            data:{
              _token:$('input[name=_token]').val()
            },
            success:function(response){
              $('#del'+id).remove();
            }
            
          })
        }
      }
  </script>
@endsection