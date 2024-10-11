  <nav class="navbar is-transparent afg-menu-header">
    <div class="navbar-brand">
      <a class="navbar-item" href="{{ route("home", app()->getLocale()) }}">
        <img src="{{ asset('images/mystery-logo.png') }}" alt="AFG logo" class="logo" >
      </a>

      <div class="navbar-item has-dropdown is-hoverable nav-lang-mobile">
        

        @include('frontend.partials.language')


      </div>

      <div class="navbar-burger burger" data-target="mobileMenu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div id="mobileMenu" class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href="#section__store">
            @lang('menu.menuItem.store')
          </a>
          <a class="navbar-item" href="#footer">
            @lang('menu.menuItem.contact')
          </a>
          <li class="navbar-item is-hidden">
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
        <a class="navbar-item" href="#section__store">
          @lang('menu.menuItem.store')
        </a>
        <a class="navbar-item" href="#footer">
          @lang('menu.menuItem.contact')
        </a>
        <li class="navbar-item is-hidden">
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

        @include('frontend.partials.language')
      </div>

       
      </div>
    </div>
  </nav>
