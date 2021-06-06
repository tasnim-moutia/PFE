@extends('layouts.app')
@extends('layouts.script')
@section('content')
<div class="container" id="profil-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="inline-block">{{ __('Modifier mon profil') }}</div>
                    <div class="inline-block"> 
                        <a href="{{route('userpro.update', $user->id)}}">Envoyer</a>   
                    </div>
                </div>
                  <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="card mb-3">
                          <div class="card-body">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Nom et prénom</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <input style="border-color:black; border-raduis: 3px" type="text" name="nom" value="{{$user->nom}}" autofocus>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Email</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <input style="border-radius: 3px" type="text" name="nom" value="{{$user->email}}">
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Numéro de téléphone</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                <input style="border-radius: 3px" type="text" name="nom" value="{{$user->num_telephone}}">
                              </div>
                            </div>
                          </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

