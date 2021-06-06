@extends('layouts.app')
@extends('layouts.script')
@section('content')

<div class="container py-3">
 
    <div class="content-header" style="margin-left: 100px">
      <h3 class="text-bold text-dark" style="margin-bottom:30px;"><strong> Vos demandes d'échange</strong></h3>
    </div>

  <div class="row">
      <div class="col-lg-10 mx-auto">
          <!-- List group-->
          <ul class="list-group shadow">
            @foreach ($notifications as $notification)
              <!-- list group item-->
              <li class="list-group-item">
                  <!-- Custom content-->
                  <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                    <div class="media" style="margin-right: 30px"><img src="{{asset('storage/echange/' . $notification->echange->image ) }}" alt="image" height="170px" width= "140px" class="ml-lg-5 order-1 order-lg-2"></div>
                      <div class="media-body">
                          <h5 class="mt-0 font-weight-bold mb-2">{{$notification->echange->en_echange}}</h5>
                          <h6 class="mt-0 font text-muted mb-2 small">Demande d'échanger de: {{$notification->echange->annonce->titre}}</h6>
                          <h6 class="mt-0 font text-muted mb-2 small">Envoyer par: {{$notification->echange->sentBy->nom}} | email: {{$notification->echange->sentBy->email}} | Appeler: {{$notification->echange->sentBy->num_telephone}}</h6>
                          <p class="font-italic text-muted mb-0 small">{{$notification->echange->description}}</p>
                          <div class="d-flex align-items-center justify-content-between mt-1">
                              <h6 class="font-weight-bold my-2">Montant supplémentaire: {{$notification->echange->montant_supplémentaire}}TND</h6>
                          </div>
                          <div class="d-flex align-items" style="margin-left:350px">
                             <ul class="list-inline small" style="margin-right:30px">
                                 <a class="btn effect01"  href="{{ route('message.conversation', $notification->echange->user_id) }}" style="border-radius: 20px; border: none; background-image:linear-gradient(to right, #e65540, #ecbc70);;
                                 padding: 8px; width: 130px; height: 40px;">Lancer un chat</a></button>
                                  &nbsp;&nbsp;
                                 {{--<a class="btn effect01"  href="{{route('delete.annonce', $annonce->id )}}">Supprimer</a></button>--}}
                                  <a href="javascript:void(0)" onclick="deleteDemande({{ $notification->id }})" class="btn" role="button" style="border-radius: 20px;
                                    border: 2px solid rgb(255, 0, 0);
                                    padding: 8px; width: 100px; height: 40px;">Refuser</a>  
                              </ul>
                          </div>  
                      </div>
                  </div> <!-- End -->
              </li> <!-- End -->
              <!-- list group item-->
              @endforeach
          </ul> <!-- End -->
      </div>
  </div>
</div>      
@csrf
  <script>
      function deleteDemande(id)
      {
        if(confirm("Voullez-vous vraiment supprimer cette demande ?"))
        {
         
          $.ajax({
            url: "/notification/"+id,
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