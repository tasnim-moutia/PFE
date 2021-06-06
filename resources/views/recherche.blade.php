@extends('layouts.app')
@extends('layouts.script')

@section('content')
<!-- Banner -->
<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
            <div class="col-sm-10 col-md-8 col-lg-6 d-flex align-item-center">
                <!-- block1 -->
                @if($annonces->isNotEmpty())
                    @foreach ($annonces as $annonce)
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <img src="{{asset('storage/annonces/' . $annonce->image ) }}" alt="IMG-BENNER">

                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a href="{{route('annonce.show', $annonce->id)}}" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                Détails
                            </a>
                        </div>
                    </div>
                    @endforeach 
                @else  
                    <div>
                        <h2>Pas d'annonces pour "<strong>{{request()->query('query')}}</strong>"</h2>
                    </div>
                @endif 
        </div>
    </div>
    {{ $annonces->appends(request()->input())->links() }}
</section>
@endsection