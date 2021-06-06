<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
   <base href="{{ \URL::to('/') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    {{ __('Se déconnecter') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
             </form>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ \URL::to('/') }}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Troké</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/admin.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->nom}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link  {{ (request()->is('admin/dashboard')) ? 'active' : '' }}" >
                  <i class="nav-icon fas fa-home fa-lg"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.list')}}" class="nav-link {{ (request()->is('dashboards/admins/users/users-list')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users fa-lg"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('categorie.list')}}" class="nav-link {{ (request()->is('dashboards/admins/categories/index')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list-alt fa-lg"></i>
                  <p>Catégories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('list.annonce')}}" class="nav-link {{ (request()->is('dashboards/admins/annonces/list-annonces')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tags fa-lg"></i>
                  <p>Annonces</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('list.ads')}}" class="nav-link {{ (request()->is('dashboards/admins/ads/list-ads')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-bell fa-lg"></i>
                  <p>Demande publicités</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('avis.list')}}" class="nav-link {{ (request()->is('dashboards/admins/avis/avis-list')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-comments fa-lg"></i>
                  <p>Les avis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.profil')}}" class="nav-link {{ (request()->is('admin/profil')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user fa-lg"></i>
                  <p>
                    Profil
                </p>
                </a>
              </li>
              
        <!-- <li class="nav-item menu-open mt-3">
               
                <ul class="nav nav-treeview ml-2">
                  <li class="nav-item">
                    <a href="{{route('users.list')}}" class="nav-link {{ (request()->is('dashboards/admins/users/users-list')) ? 'active' : '' }}">
                      <i class="fa-xs fa fa-users "></i>
                      <p>Utilisateurs</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('categorie.list')}}" class="nav-link {{ (request()->is('dashboards/admins/categories/index')) ? 'active' : '' }}">
                      <i class=" fa-xs fa fa-list-alt "></i>
                      <p>Catégories</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('list.annonce')}}" class="nav-link {{ (request()->is('dashboards/admins/annonces/list-annonces')) ? 'active' : '' }}">
                      <i class=" fa-xs fa fa-tags "></i>
                      <p>Annonces</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('list.ads')}}" class="nav-link {{ (request()->is('dashboards/admins/ads/list-ads')) ? 'active' : '' }}">
                      <i class=" fa-xs fa fa-bell "></i>
                      <p>Demande publicités</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('avis.list')}}" class="nav-link {{ (request()->is('dashboards/admins/avis/avis-list')) ? 'active' : '' }}">
                      <i class=" fa-xs fa fa-comments"></i>
                      <p>Les avis</p>
                    </a>
                  </li>
                </ul>
              </li>
               
              <li class="nav-item mt-3">
                <a href="{{route('admin.profil')}}" class="nav-link {{ (request()->is('admin/profil')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-user fa-lg"></i>
                  <p>
                    Profil
                </p>
                </a>
              </li>
                {{--<li class="nav-item">
                    <a href="{{route('admin.settings')}}" class="nav-link {{ (request()->is('admin/settings')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cog fa-lg"></i>
                    <p>
                        Settings
                    </p>
                    </a>
                </li>--}}
        </ul>-->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      troker@gmail.com
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="#">Troké</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
