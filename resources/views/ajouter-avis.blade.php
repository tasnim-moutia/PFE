@extends('layouts.app')
@extends('layouts.script')
@section('content')
        
<div class="container" id="profil-form">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Donner un avis') }}</div>
                  <div class="card-body">
                    @if ($message = Session::get('avis_ajouté'))
                       <div class="alert alert-success">
                          <p>{{ $message }}</p>
                       </div>
                    @endif
                      <form action="{{route('save.avis')}}" method="POST">
                        @csrf
                        <h5>Nom</h5><input type="text" name="nom" class="border-2 rounded-lg" placeholder="Saisir votre nom"><br>
                                    <span class="text-danger">@error('nom') {{ $message }} @enderror</span>
                        <br><h5>Votre message</h4>
                            <textarea name="message" id="message" cols="50" rows="5" class="border-2 w-full p-4 rounded-lg" placeholder="Vous avez trouvé un lien qui ne fonctionne pas ? une faute de frappe ? Vous avez des suggestions pour améliorer notre site ou des questions? Merci de nous faire part et les écrivez ici ! &#10;&#10; Vos remarques nous intéressent :)"></textarea>
                            <span class="text-danger">@error('message') {{ $message }} @enderror</span>
                            <br><br>
                        <div class="pull-right">
                            <button type="reset" class="btn btn-primary " style="background-color:  #e65540; border-color: #e65540">
                                <a href="/" style="color: #ffff; text-decoration: none;">{{ __('Annuler') }}</a> 
                            </button>
                            &nbsp; &nbsp;
                            <button type="submit" class="btn btn-primary " style="background-color: #e65540; border-color:#e65540">
                                {{ __('Envoyer') }}
                            </button>
                        </div>
                      </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection