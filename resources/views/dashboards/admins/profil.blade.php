@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Profil')
    
@section('content')
<div class="container-one"></div>

<div class="content-wrapper px-4 py-5 ml-1">
<div class="row">
    <div class=" col-md-3">
      <div class="card card-primary ">
      <div class="card-body box-profile">
        <div class="text-center">
          <img style="margin-top: 48px" class="profile-user-img img-fluid img-circle" src="../../dist/img/admin.jpg" alt="User profile picture">
        </div>
        <br>
        <h3 class="profile-username text-center"> {{ Auth::user()->nom }}</h3>
        <p style="margin-bottom:23px" class="text-muted text-center">Admin</p>
      </div>
      </div>
    </div>
      <!-- /.card-body -->

	<div class=" col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                  <h5 class="mb-0"><strong> Mon profil</strong></h5>
                </div>
                <div class="col-sm-3"> </div>
                <div class="col-sm-3"> </div>
                <div class="col-sm-3">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                  @foreach ($users as $user)@endforeach
                  <a href="{{route('profil.edit', $user->id)}}"><img src="dist/img/modif.png" alt="edit"></a> 
                </div>
              </div>
              <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nom et prénom</h6>
              </div>
              
              <div class="col-sm-3"> </div>
              <div class="col-sm-3 text-secondary">
                {{ Auth::user()->nom }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-3"> </div>
              
              <div class="col-sm-3 text-secondary">
                {{ Auth::user()->email }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Numéro de téléphone</h6>
              </div>
              <div class="col-sm-3"> </div>
              
              <div class="col-sm-3 text-secondary">
                {{ Auth::user()->num_telephone }}
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Role</h6>
              </div>
              <div class="col-sm-3"> </div>
             
              <div class="col-sm-3 text-secondary">
                Admin
              </div>
            </div>
           
          </div>
        </div>
    </div>
</div>
</div>
@endsection

