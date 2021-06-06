@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Modifier profil')
    
@section('content')
<div class="container-one"></div>

<div class="content-wrapper px-4 py-5 ml-1">
  <div class="row">
    <div class=" col-md-3">
      <div class="card card-primary ">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="../../dist/img/admin.jpg" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center"> {{ Auth::user()->nom }}</h3>

        <p class="text-muted text-center">Admin</p>
        <a href="#" class="btn btn-primary btn-block"><b>Modifier</b></a>
      </div>
      </div>
    </div>
      <!-- /.card-body -->
    <div class=" col-md-8">
          <div class="card mb-3">
            <div class="card-body">
                  @if (Session::has('success'))
                  <span>{{Session::get('success')}}</span>
                  @endif
              <form action="{{route('profil.update', $users->id)}}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{$users->id}}">
              <div class="row" style="margin-top: 10px">
                <div class="col-sm-4">
                  <h6 class="mb-0">Nom et prénom</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                  <input style="border-radius: 3px" type="text" name="nom">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-4">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                  <input style="border-radius: 3px" type="text" name="nom">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-4">
                  <h6 class="mb-0">Numéro de téléphone</h6>
                </div>
                <div class="col-sm-8 text-secondary">
                  <input style="border-radius: 3px" type="text" name="nom">
                  
                </div>
              </div>
              <div class="pull-right" style="margin-left: 400px">
                  <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <!--<a href="#" class="btn btn-primary "><b>Modifier</b></a> 
                  <a href="#" class="btn btn-primary "><b>Annuler</b></a>  -->
                  <!--<button type="submit" style="border-radius: 8px; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19)">Modifier</button>
                  <button style="border-radius: 8px; box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19)"><a href="{{ route('admin.profil') }}"> Annuler </a></button>
                  -->
              </div>
            </form>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection