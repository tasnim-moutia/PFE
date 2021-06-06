@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Modifier une catégorie')
    
@section('content')
<div class="container-one">

</div>
<div class="content-wrapper px-4 py-2 ml-1">
	<div class="content-header">
		<h3 class="text-bold text-dark mt-3">Modifier le nom du catégorie</h3>
    </div>
    <div class="content px-2">
		

        <h5 class="text-bold text-dark mt-5"></h5>

         <div class="card">
            <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> vérifier le nom saisie.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                            <p>{{ $message }}</p>
                            </div>
                        @endif
                
                    <form action="{{route('update.categories')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{$categories->id}}">
                                        <strong>Nom:</strong>
                                        <br><input type="text" name="nom_categorie" value="{{ $categories->nom_categorie }}" class="form-control" placeholder="Nom de la catégorie">
                                    </div>
                                    <div class="pull-right" style="margin-left: 800px">
                                     <button  class="btn btn-outline-danger" style="border-radius: 8px;"><a href="{{ route('categorie.list') }}" style="color:rgb(236, 44, 44); text-decoration: none;"> Annuler </a></button>
                                     <button  class="btn btn-outline-success" type="submit" style="border-radius: 8px;">Modifier</button>
                                    </div>
                            </div>
                    </form>
                
            </div>
       
      </div>
</div>
    
</div>
@endsection