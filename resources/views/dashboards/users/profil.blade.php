@extends('layouts.app')
@extends('layouts.script')
@section('content')
<div class="container" id="profil-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="inline-block">{{ __('Mon profil') }}</div>
                    <div class="inline-block"> 
                      @foreach ($user as $use)@endforeach
                        <a href="{{route('userpro.edit', $use->id)}}"><img src="{{asset('assets/images/modif.png')}}" alt="IMG-LOGO"></a>   
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
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Nom et prénom</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                {{ Auth::user()->nom }}
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Email</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                {{ Auth::user()->email }}
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-4">
                                <h6 class="mb-0">Numéro de téléphone</h6>
                              </div>
                              <div class="col-sm-8 text-secondary">
                                {{ Auth::user()->num_telephone }}
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

