  <nav class="navbar is-transparent">
    <div class="navbar-brand">
      <a class="navbar-item" href="{{ route("home", app()->getLocale()) }}">
        <img src="{{ asset('img/logo.png') }}" alt="AFG logo" width="112" height="28">
      </a>

      <div class="navbar-item has-dropdown is-hoverable nav-lang-mobile">
        
        <a class="navbar-link" data-toggle="dropdown">
          @if(app()->getLocale() == 'en')
            <span class="navbar-lang">
              <i class="flag-icon flag-icon-us"></i> EN
            </span>
          @else
            <span class="navbar-lang">
              <i class="flag-icon flag-icon-vn"></i> VI
            </span>
          @endif
        </a>
        <div class="navbar-dropdown is-boxed">
          <a href="{{ route('home', 'vi') }}" class="navbar-item dropdown-item">
            <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
          </a>
          <a href="{{ route('home', 'en') }}" class="navbar-item dropdown-item">
            <i class="flag-icon flag-icon-us mr-2"></i> English
          </a>       
        </div>
      </div>

      <div class="navbar-burger burger" data-target="mobileMenu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div id="mobileMenu" class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href="#">
            @lang('menu.menuItem.store')
          </a>
          <a class="navbar-item" href="#">
            @lang('menu.menuItem.contact')
          </a>
          <li class="navbar-item">
              @lang('menu.menuItem.support')
            
            <a class="" href="#">
              <span class="icon"><i class="fab fa-facebook-f"></i></span>
            </a>
            <a class="" href="#">
              <span class="icon"><i class="fab fa-linkedin-in"></i></span>
            </a>
          </li>
          <hr class="is-divider">
          @auth
            <div class="navbar-item">
                <strong class="d-none d-md-inline"> @lang('menu.hello'), {{  Auth::user()->name }}</strong>
            </div>
      
              <a class="navbar-item" href="{{ route('user.profile', app()->getLocale()) }}"> @lang('menu.menuItem.profile')</a>
          
                <a class="navbar-item" href="{{ route('user.logout', app()->getLocale()) }}"
                  onclick="event.preventDefault();
                              document.getElementById('user-logout-form').submit();">
                  @lang('user.logout') 
                </a>
            
                <form id="user-logout-form" action="{{ route('user.logout', app()->getLocale()) }}" method="POST" style="display: none;">
                    @csrf
                </form>
        
          
        @else   
          <div class="navbar-item">
            <div class="field is-grouped">
              <p class="control">
                <a class="button is-primary is-outlined is-small" href="{{ route('user.login', app()->getLocale()) }}"> @lang('user.login')</a>
              </p>
              <p class="control">
                <a class="button is-primary is-small" href="{{ route('user.register', app()->getLocale()) }}"> @lang('user.register')</a>
              </p>
            </div>
          </div>
    
        @endauth
        
        </div>
    </div>
    <div id="desktopMenu" class="navbar-menu">
      <div class="navbar-start">
     
       
      </div>
  
      <div class="navbar-end">
        <a class="navbar-item" href="#">
          @lang('menu.menuItem.store')
        </a>
        <a class="navbar-item" href="#">
          @lang('menu.menuItem.contact')
        </a>
        <li class="navbar-item ">
            @lang('menu.menuItem.support')
          <a class="navbar-item" href="#">
            <span class="icon"><i class="fab fa-facebook-f"></i></span>
          </a>
          <a class="navbar-item" href="#">
            <span class="icon"><i class="fab fa-linkedin-in"></i></span>
          </a>
        </li>
        <span class="navbar-item">|</span>
        @auth
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link" href="#">
            <span class="d-none d-md-inline"> @lang('menu.hello'), {{  Auth::user()->name }}</span>
          </a>
          <div class="navbar-dropdown is-boxed">
            <a class="navbar-item" href="{{ route('user.profile', app()->getLocale()) }}"> @lang('menu.menuItem.profile')</a>
            <hr class="navbar-divider">
            <a class="navbar-item" href="{{ route('user.logout', app()->getLocale()) }}"
              onclick="event.preventDefault();
                          document.getElementById('user-logout-form').submit();">
              @lang('user.logout') 
            </a>
        
            <form id="user-logout-form" action="{{ route('user.logout', app()->getLocale()) }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      @else   
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            <a class="button is-primary is-outlined is-small" href="{{ route('user.login', app()->getLocale()) }}"> @lang('user.login')</a>
          </p>
          <p class="control">
            <a class="button is-primary is-small" href="{{ route('user.register', app()->getLocale()) }}"> @lang('user.register')</a>
          </p>
        </div>
      </div>
   
      @endauth
      <div class="navbar-item has-dropdown is-hoverable">
        
   

       
        <a class="navbar-link" data-toggle="dropdown">
          @if(app()->getLocale() == 'en')
            <span class="navbar-lang">
              <i class="flag-icon flag-icon-us"></i> EN
            </span>
          @else
            <span class="navbar-lang">
              <i class="flag-icon flag-icon-vn"></i> VI
            </span>
          @endif
        </a>
        <div class="navbar-dropdown is-boxed">

          @if( Route::currentRouteName() == 'user.survey.detail')

            @php 
    
              $slug = Request::segment(3);
    
    
              $id = preg_match_all('!\d+!', $slug, $matches);
              $id = implode(' ', $matches[0]);
    
              $slug = preg_replace('!\d+!', '', $slug);
              $slug = substr($slug, 1);
    
            @endphp
          

            <a href="{{ route(Route::currentRouteName(), ['vi', $id, $slug]) }}" class="navbar-item dropdown-item">
              <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
            </a>
            <a href="{{ route(Route::currentRouteName(), ['en', $id, $slug]) }}" class="navbar-item dropdown-item">
              <i class="flag-icon flag-icon-us mr-2"></i> English
            </a>       

          @else

            <a href="{{ route(Route::currentRouteName(), 'vi') }}" class="navbar-item dropdown-item">
              <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
            </a>
            <a href="{{ route(Route::currentRouteName(), 'en') }}" class="navbar-item dropdown-item">
              <i class="flag-icon flag-icon-us mr-2"></i> English
            </a>       


          @endif




        </div>
      </div>

       
      </div>
    </div>
  </nav>
