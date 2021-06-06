@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Les demande pub')
@section('content')
<div class="container-one">

</div>
<div class="content-wrapper px-4 py-2 ml-1" id="profil-form">
	<div class="content-header">
		<h3 class="text-bold text-dark mt-3">Les demandes de publicité</h3>
    </div>

    <div class="content px-2 py-2">

        <div class="card">

       <div class="card-body">
                  @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table  class="table table-hover ">
                        <tr>
                            <th scope="col">Annonce</th>
                            <th scope="col">Image</th>
                            <th scope="col">Prix à payer</th>
                            <th scope="col">Date de création</th>
                            <th scope="col">Détails annonce</th>
                            <th scope="col">Confirmer</th>
                            <th scope="col">Supprimer</th>
                        </tr>
                        @foreach ($ads as $ad)
                        <tr style="justify-center" >
                          <th scope="row">{{$ad->annonce->titre}}</th>
                          <td><img style="hight:60px; width:80px" src="{{asset('storage/ads/' . $ad->img ) }}" ></td>
                          <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$ad->prix}}</td>
                          <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{date_format($ad->created_at, 'd-M-Y')}}</td>
                          <td><a href="{{route('detail.annonce', $ad->id )}}"> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="dist/img/view.png" alt="info"></a></td>
                          <td><form method="post" action="{{route('confirm.ads', $ad->id)}}">
                                @csrf
                                <input type="hidden" name="adID" value="$ads->id" />
                                
                                    @if ($ad->confirmer == false)
                                    <button class="btn " type="submit"><img src="dist/img/conf.png" alt="valider"></button>
                                    @else
                                    &nbsp&nbsp&nbsp<img src="dist/img/tik.png" alt="confirmer">
                                    @endif
                               
                               </form>
                          </td>
                          {{--<td><a href="#"><img src="dist/img/validate-icon-3.png" alt="confirmer"></a></td>--}}
                         
                          {{--<td><a href="#"><img src="dist/img/delete-icon-png-red-5-Transparent-Images.png" alt="refuser"></a></td>--}}
                          <td><a href="javascript:void(0)" onclick="deleteAd({{ $ad->id }})" class="btn" role="button"><img src="dist/img/x.png" alt="delete"></i></a></td>
                        
                        </tr>
                        @endforeach
                    </table>
         </div>
    </div>
</div>
    
</div>
@csrf
  <script>
      function deleteAd(id)
      {
        if(confirm("Voullez-vous supprimer vraiment cette demande ?"))
        {
         
          $.ajax({
            url: "/dashboards/admins/ads/delete-ad/"+id,
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


