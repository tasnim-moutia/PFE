@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Modifier annonce')
@section('content')
<div class="content-wrapper px-4 py-2 ml-1">
    <div class="content-header">
		<h3 class="text-bold text-dark mt-3">Modifier annonce</h3>
    </div>
	<div class=" content-wrapper px-4 py-2 ml-1">
        <div class="card mb-3">
          <div class="card-body">
           
            @if ($message = Session::get('success'))
                <div class="alert alert-success" style="background-color: rgb(139, 224, 139)">
                <p>{{ $message }}</p>
                </div>
            @endif
                
            <form action="{{route('annonce.update', $annonces->id)}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$annonces->id}}">
            <div class="row">
              <div class="col-sm-4">
                <h6 class="mb-0">Titre</h6>
              </div>

              <div class="col-sm-8 text-secondary">
                <input type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" style="border-radius: 3px;border-width: 1px; width: 100%" value="{{$annonces->titre}}">
                @error('titre')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4">
                <h6 class="mb-0">Catégorie</h6>
              </div>
              <div class="col-sm-8 text-secondary">
                <select class="form-control" name="categorie_id" id="categorie_id">
                    @foreach ($categories as $categorie)
                     <option value="{{$categorie->id}}">{{$categorie->nom_categorie}}</option>
                    @endforeach
                </select>
                <span class="text-danger">@error('selectcategory') {{ $message }} @enderror</span>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <h6 class="mb-0">Description</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                    <input type="text"  class="form-control @error('description') is-invalid @enderror" name="description" style="border-radius: 3px;border-width: 1px; width: 100%" value="{{$annonces->description}}">
                    @error('description')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
            <br>
            <div class="pull-right" style="margin-left:750px">
                
                <button  class="btn btn-outline-danger" style="border-radius: 8px;"><a href="{{ route('list.annonce') }}" style="color:rgb(236, 44, 44); text-decoration: none;"> Annuler </a></button>
                <button  class="btn btn-outline-success" type="submit" style="border-radius: 8px;">Modifier</button>
              </div>
          </form>
          </div>
        </div>
    </div>
</div>
@endsection

