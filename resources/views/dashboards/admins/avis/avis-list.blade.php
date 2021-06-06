@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Avis')
@section('content')
<div class="container-one">

</div>
<div class="content-wrapper px-4 py-2 ml-1" id="profil-form">
	<div class="content-header">
		<h3 class="text-bold text-dark mt-3">Avis</h3>
    </div>

    <div class="content px-2 py-2">

        <div class="card">

       <div class="card-body">
                     @if (Session::has('avis_supprimé'))
                       <span>{{Session::get('avis_supprimé')}}</span>
                    @endif
                    <table  class="table table-hover">
                        <tr>
                            <th>Nom</th>
                            <th>Message</th>
                            {{--<th>Modifier</th>--}}
                            <th>Supprimer</th>
                        </tr>
                        @foreach ($avis as $avi)
                        <tr>
                            <td>{{$avi->nom}}</td>
                            <td>{{$avi->message}}</td>
                             {{--<td><a href="/dashboards/admins/avis/edit-avis/{{$avi->id}}"><img src="dist/img/edit.jpg" alt="edit"></a></td>--}}
                               
                            {{--<td><a href="/dashboards/admins/avis/delete-avis/{{$avi->id}}"><img src="dist/img/delete.jpg" alt="delete"></a></td>--}}
                            <td><a href="javascript:void(0)" onclick="deleteAvis({{ $avi->id }})" class="btn" role="button" ><img src="dist/img/x.png" alt="delete"></a></td>
                        </tr>
                        @endforeach
                    </table>
         </div>
    </div>
</div>
    
</div>
@csrf
  <script>
      function deleteAvis(id)
      {
        if(confirm("Voullez-vous supprimer vraiment cette avis ?"))
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

