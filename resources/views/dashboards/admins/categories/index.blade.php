@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Catégorie')
    
@section('content')
<div class="container-one">

</div>
<div class="content-wrapper px-4 py-2 ml-1">
	<div class="content-header">
		<h3 class="text-bold text-dark mt-3">Catégories</h3>
    </div>

    <div class="content px-2">
		

         <div class="card">
            <div class="card-header">
            
             <div class="card-tools">
                <div class="pull-right">
                    <a class="btn" href="{{ route('create.categorie') }}" title="créer une nouvelle catégorie" style="background-color:rgb(255, 165, 0)"> <i class="fas fa-plus-circle"> Ajouter</i>
                        </a>
                </div>
             </div>
        </div>
       <div class="card-body">
              @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                  <p>{{ $message }}</p>
                  </div>
             @endif
        
            <table class="table table-hover">

                <tr>
                    <th>Nom Catégorie</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>{{$categorie->nom_categorie}}</td>
                        
                        <td><a href="/dashboards/admins/categories/edit/{{$categorie->id}}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="dist/img/modif.png" alt="edit"></a></td>
                        {{--<td><a onclick="confirmer()" href="/dashboards/admins/categories/delete/{{$categorie->id}}"><img src="dist/img/delete.jpg" alt="delete"></a> --}}
                        
                        <td><a href="javascript:void(0)" onclick="deleteCategorie({{ $categorie->id }})" class="btn" role="button" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="dist/img/x.png" alt="delete"></i></a></td>
                    </tr>
                @endforeach
        </table>
     </div>   
  </div>
</div>
    
</div>
@csrf
  <script>
      function deleteCategorie(id)
      {
        if(confirm("Voullez-vous supprimer vraiment cette Catégorie ?"))
        {
         
          $.ajax({
            url: "/dashboards/admins/categories/delete-categorie/"+id,
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