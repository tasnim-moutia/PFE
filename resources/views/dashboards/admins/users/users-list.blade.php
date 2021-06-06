@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Listes des clients')
    
@section('content')
<div class="container-one">

</div>
<div class="content-wrapper px-4 py-2 ml-1">
	<div class="content-header">
		<h3 class="text-bold text-dark mt-3">Liste des utilisateurs</h3>
    </div>

    <div class="content px-2">
		

         <div class="card">
           
         <div class="card-body">
              @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                  <p>{{ $message }}</p>
                  </div>
             @endif
        
            <table class="table table-hover">

                <tr>
                    <th>Nom et prénom</th>
                    <th>Email</th>
                    <th>Numéro de téléphone</th>
                    <th>Valider</th>
                    <th>Supprimer</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->nom}}</td>
                        <td>{{$user->email}}</td>
                        <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$user->num_telephone}}</td>
                        <td><form method="post" action="{{route('validate.user', $user->id)}}">
                            @csrf
                            <input type="hidden" name="userID" value="$users->id" />
                            
                                @if ($user->valide == false)
                                <button class="btn " type="submit"><img src="dist/img/conf.png" alt="valider"></button>
                                @else
                                 &nbsp&nbsp&nbsp<img src="dist/img/tik.png" alt="valider">
                                @endif
                           
                           </form>
                      </td>
                        {{--<td><a href="/dashboards/admins/users/delete/{{$user->id}}"><img class="ml-4" src="dist/img/delete-icon-png-red-5-Transparent-Images.png" alt="delete"></a></td>--}}
                        <td><a href="javascript:void(0)" onclick="deleteUser({{ $user->id }})" class="btn" role="button" ><img src="dist/img/x.png" alt="delete"></a><td>
                    </tr>
                @endforeach
        </table>
     </div>   
  </div>
</div>
    
</div>
@csrf
  <script>
      function deleteUser(id)
      {
        if(confirm("Voullez-vous supprimer vraiment cet utilisateur ?"))
        {
         
          $.ajax({
            url: "/dashboards/admins/users/delete-user/"+id,
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