@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Les annonces')
@section('content')
<div class="container-one">

</div>
<div class="content-wrapper px-4 py-2 ml-1" id="profil-form">
	<div class="content-header">
		<h3 class="text-bold text-dark mt-3">Les annonces</h3>
    </div>

    <div class="content px-2 py-2">
       
        <div class="card">
            
       <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table  class="table table-hover">
                        <tr>
                            <th scope="col">Publier par</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Catégorie</th>
                            {{--<th scope="col">Image</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Description</th>
                            <th scope="col">Estimation</th>
                            <th scope="col">Date de création</th>--}}
                            <th scope="col">Détails</th>
                            <th scope="col">Valider</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Supprimer</th>
                            
                        </tr>
                        @foreach ($annonces as $annonce)
                        <tr>
                          <th scope="row">{{$annonce->user->nom}}</th>
                          <td>{{$annonce->titre}}</td>
                          <td>{{$annonce->categorie->nom_categorie}}</td>
                     {{-- <td><img style="hight:32px; width:32px" src="{{asset('storage/annonces/' . $annonce->image ) }}" ></td>
                          <td>{{$annonce->categorie->nom_categorie}}</td>
                          <td>{{$annonce->description}}</td>
                          <td>{{$annonce->estimation}}</td>
                          <td>{{date_format($annonce->created_at, 'd-M-Y')}}</td>--}}
                          <td><a href="{{route('show.annonce', $annonce->id )}}">&nbsp&nbsp<img src="dist/img/view.png" alt="info"></a></td>
                          <td><form method="post" action="{{route('validate.annonce', $annonce->id)}}">
                                @csrf
                                  <input type="hidden" name="annonceID" value="$annonces->id" />
                            
                                @if ($annonce->valid == false)
                                <button class="btn " type="submit"><img src="dist/img/conf.png" alt="valider"></button>
                                @else
                                &nbsp&nbsp&nbsp<img src="dist/img/tik.png" alt="valider">
                                @endif
                           
                               </form>
                          </td>   
                          <td><a href="{{route('annonce.edit', $annonce->id )}}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="dist/img/modif.png" alt="edit"></a></td>
                              {{--<a href="{{route('annonce.delete', $annonce->id )}}"><img src="dist/img/delete-icon-png-red-5-Transparent-Images.png" alt="delete"></a>--}}
                          <td><a href="javascript:void(0)" onclick="deleteAnnonce({{ $annonce->id }})" class="btn" role="button" >&nbsp&nbsp&nbsp&nbsp<img src="dist/img/x.png" alt="delete"></a></td>
                        </tr>
                        @endforeach
                    </table>
         </div>
    </div>
</div>
    
</div>
@csrf
  <script>
      function deleteAnnonce(id)
      {
        if(confirm("Voullez-vous supprimer vraiment cette annonce ?"))
        {
         
          $.ajax({
            url: "/dashboards/admins/avis/delete-avis/"+id,
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

