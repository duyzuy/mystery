<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MYSTERY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     
      @guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
     
      @endguest
    </ul>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('manage.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'manage.dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">HOME</li>
          <li class="nav-item">
            <a href="{{ route('manage.slider.index') }}" class="nav-link {{ Request::is('manage/homepage/slider*') ? 'active' : '' }}">  
              <i class="nav-icon fas fa-book"></i>
              <p>Slider</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('manage.homepage.index') }}" class="nav-link {{ Request::is('manage/homecontent*') ? 'active' : '' }}">  
              <i class="nav-icon fas fa-book"></i>
              <p>Content</p>
            </a>
          </li>
         
          <li class="nav-header">SURVEY</li>
          <li class="nav-item">
            <a href="{{ route('manage.questionnaire.index') }}" class="nav-link {{ Request::is('manage/questionnaire*') ? 'active' : '' }}">  
              <i class="nav-icon fas fa-book"></i>
              <p>Questionnaire</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('manage.questiongroup.index') }}" class="nav-link {{ Request::is('manage/questiongroup*') ? 'active' : '' }}">  
              <i class="nav-icon fas fa-book"></i>
              <p>Question Groups</p>
            </a>
          </li>
          <li class="nav-header">CONTENT</li>
          <li class="nav-item">
            <a href="{{ route('manage.cities') }}" class="nav-link {{ Request::is('manage/cities*') ? 'active' : '' }}">  
              <i class="fas fa-city nav-icon"></i>
              <p>Cities</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('stores.index') }}" class="nav-link  {{ Request::is('manage/store*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Store</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('manage.user.list') }}" class="nav-link  {{ Request::is('manage/user*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-header">REPORT</li>
          <li class="nav-item">
            <a href="{{ route('manage.questionnaire.report') }}" class="nav-link {{ Request::is('manage/report/questionnaires*') ? 'active' : '' }}">  
              <i class="fas fa-city nav-icon"></i>
              <p>Questionnaire</p>
            </a>
          </li>
         
          <li class="nav-item text-center border mt-3">
            <a class="nav-link" href="{{ route('admin.logout') }}"
              onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
        
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
