@extends('frontend.master')



@section('title', 'Longin')

@section('content')
<div class="wrap-login-page">
<div class="container is-fluid">
    <div class="columns">
        <div class="column is-three-fifths is-offset-one-fifth">
            <div class="card">
                <div class="card-header">
                    <h1 class="title is-size-4 has-text-centered">@lang('user.loginPage.label')</h1>
                </div>
                <div class="card-content">
                    <form method="POST" action="{{ route('user.login.submit', app()->getLocale()) }}">
                        @csrf
                        
                        <div class="field">
                            <label class="label">@lang('user.loginPage.labelEmail')</label>
                            <div class="control has-icons-left has-icons-right">
                              <input class="input @error('email') is-danger @enderror" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                              <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                              </span>
                            </div>
                            @error('email')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                            
                        </div>
        
                        <div class="field">
                            <label class="label">@lang('user.loginPage.labelPassword')</label>
                            <div class="control has-icons-left has-icons-right">
                              <input class="input @error('password') is-danger @enderror" type="password" name="password" autocomplete placeholder="Password">
                              <span class="icon is-small is-left">
                                <i class="fas fa-key"></i>
                              </span>
                            </div>
                                @error('password')
                                    <p class="help is-danger">{{ $message }}</p>       
                                @enderror
                        </div>
        
                        <div class="field">
                            
                            <p class="control mt-5">
                                <button type="submit" class="button is-primary is-outlined is-fullwidth">
                                    @lang('user.button.login')
                                </button>
        
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </p>
                            <p class="control mt-3 has-text-centered">
                                <a class="is-size-7 has-text-primary" href="{{ route('user.register', app()->getLocale()) }}">@lang('user.button.haveNoAccount')</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>
</div>
@endsection

