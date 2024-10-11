
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
            {{-- @if( Route::currentRouteName() == 'user.survey.detail')
  
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
            @elseif(Route::currentRouteName() == 'user.thankyou')
              @php 
        
              $slug = Request::segment(2);
              $token = substr($slug, strrpos($slug, '=' )+1);
  
            @endphp
              <a href="{{ route(Route::currentRouteName(), ['vi', $token]) }}" class="navbar-item dropdown-item">
                <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
              </a>
              <a href="{{ route(Route::currentRouteName(), ['en', $token]) }}" class="navbar-item dropdown-item">
                <i class="flag-icon flag-icon-us mr-2"></i> English
              </a>       
  
            @else
  
              <a href="{{ route(Route::currentRouteName(), 'vi') }}" class="navbar-item dropdown-item">
                <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
              </a>
              <a href="{{ route(Route::currentRouteName(), 'en') }}" class="navbar-item dropdown-item">
                <i class="flag-icon flag-icon-us mr-2"></i> English
              </a>       
  
            @endif --}}

            <a href="{{ route('home', 'vi') }}" class="navbar-item dropdown-item">
                <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
              </a>
              <a href="{{ route('home', 'en') }}" class="navbar-item dropdown-item">
                <i class="flag-icon flag-icon-us mr-2"></i> English
              </a>       
     
          </div>