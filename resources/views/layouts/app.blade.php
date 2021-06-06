<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('assets/images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/themify/themify-icons.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/elegant-font/html-css/style.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/lightbox2/css/lightbox.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
<!--===============================================================================================-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Troké') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/min.js') }}"></script>
	<script src="https://cdn.socket.io/4.1.1/socket.io.min.js" 
	        integrity="sha384-cdrFIqe3RasCMNE0jeFG9xJHog/tgOVC1E9Lzve8LQN1g5WUHo0Kvk1mawWjxX7a" 
	        crossorigin="anonymous">
   </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" 
          integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" 
          crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div id="app">
     <header>
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a href="/" class="logo">
					<img src="{{asset('assets/images/icons/tok.png')}}" alt="IMG-LOGO">
				</a>
                  
                <div class="wrap_menu" style="margin-left: 50px">
					<nav class="menu">
						<ul class="main_menu">
							
							<li>
								<a  href="/">Accueil</a>
								
							</li>

							<li>
								<a  href="{{route('show.categorie')}}">Catégories</a>
								<ul class="sub_menu">
									{{-- @foreach ($categories as $item)
										<li><a href="#">{{$item->nom_categorie}}</a></li>
									@endforeach --}}
									<li><a href="#">Loisirs</a></li>
									<li><a href="#">Déco</a></li>
									<li><a href="#">Magains</a></li>
									<li><a href="#">Bricolage</a></li>
									<li><a href="#">Electro</a></li>
									<li><a href="#">Audio Video</a></li>
									<li><a href="#">Multimédia</a></li>
									<li><a href="#">Meubles d’occasion</a></li>	
								</ul>
							</li>

							<li class="sale-noti">
								<a  href="{{route('annonce.list')}}">Mes Annonces</a>
							</li>

							<li>
								<a  href="{{ route('ajouter.avis')}}">Avis</a>
							</li>

							<li>
								<a  href="{{route('contact.list')}}">Contact</a>
							</li>
						</ul>
					</nav>
					
				</div>

                <span class="linedivide1"></span>

                
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
						<form  role="search" action="{{route('annonce.search')}}" method="GET">
							{{ csrf_field() }}
							<input id="search" type="search" name="query"  placeholder="Rechercher..."  />
							<button type="submit"><img src="{{asset('assets/images/icons/recherche1.png')}}" alt="ICON"></button>    
						</form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
										<img src="{{asset('assets/images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
									</a>
                                </li>
                            @endif
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nom }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('user.profil') }}">
                                        {{ __('Mon profil') }}
                                    </a>
                                   <form id="profil-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    
									<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

                <span class="linedivide1"></span>

					<div class="header-wrapicon2">
						@if (Route::has('login'))
						<div class="hidden fixed">
							@auth

							<a href="{{ route('user.chat') }}"><img src="{{asset('assets/images/icons/chat.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON"></a>&nbsp;
							<a href="{{ route('notification.list') }}"><img src="{{asset('assets/images/icons/pngegg.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON"></a>
							

							<!-- Header cart noti -->
							
							@endauth
						</div>
					 @endif
				    </div>
            </div>
        </nav>
    </header>

        <main class="py-4">
            @yield('content')
        </main>

     <!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Suivez nous
				</h4>

				<div>
					<p class="s-text7 w-size27">
						Rejoignez notre communauté et n'hésitez pas à nous contacter pour plus d'information.
					</p>

					<div class="flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div>
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Catégories
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Loisirs
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Déco
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Magasins
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Bricolage
						</a>
					</li>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Electro
						</a>
					</li>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Audio Video
						</a>
					</li>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Multimédia
						</a>
					</li>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Meubles d’occasion
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Liens
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Comment troquer ?
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Qui sommes nous ?
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Contactez-Nous
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Politiques de confidentialités
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Aide
				</h4>

				<ul>
					

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Retour
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Livraison
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							FAQs
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@gmail.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Abonnez-Vous
						</button>
					</div>

				</form>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<div class="t-center s-text8 p-t-20">
				Copyright © 2021 All rights reserved. <i class="fa fa-heart-o" aria-hidden="true"></i> <a href="#" target="_blank">Troké</a>
			</div>
		</div>
	</footer>

    <!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>
    
	
	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
    </div>

    
</body>
</html>

