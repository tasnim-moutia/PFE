@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Avis')
@section('content')
 <div class="container-one"></div>
  <div class="content-wrapper px-4 py-2 ml-1">
        <div class="content-header">
            <h1 class="text-dark">Modifier les avis</h1>
        </div>

        <div class="content px-2">
            <p></p>
           <h5 class="text-bold text-dark mt-5"></h5>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Modifier avis') }}</h3>
                    <div class="card-tools">
                        <div class="pull-right">
                            
                        </div>
                    </div>
            </div>
                <div class="card-body">
                    @if (Session::has('avis_modifié'))
                    <span>{{Session::get('avis_modifié')}}</span>
                    @endif

                  <form action="{{route('update.avis')}}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{$avis->id}}">
                     <h4>Nom</h4><input type="text" name="nom" value="{{$avis->nom}}">
                     <h4>Votre message</h4><textarea name="message" id="message" cols="30" rows="10">{{$avis->message}}</textarea>
                     <br><input type="submit" value="modifier">
             
                 </form>
               </div>
        
        </div>
  </div>
  </div>
    

@endsection





