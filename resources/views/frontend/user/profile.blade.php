@extends('frontend.master')

@section('title', 'Profile')

@section('content')
<section class="hero is-primary header-profile">
    <div class="header-section">
        <div class="hero-body">
            <div class="container has-text-centered wrap__name">
              <h1 class="title is-uppercase has-text-centered name">
                {{ Auth::user()->name }}
              </h1>
            </div>
          </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-6">
                <div class="box box-info">
                    <h3 class="title is-size-5">@lang('user.profile.title')</h3>
                    <hr class="is-divider">
                    <div class="box-content">
                        <ul>
                            <li>
                                <span class="icon"><i class="fas fa-envelope"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.email'):</span> 
                                <span class="is-float-right ">{{ Auth::user()->email }}</span>
                               
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.address'):</span> 
                                <span class="is-float-right ">{{ Auth::user()->address }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-utensils"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.restaurent'):</span> 
                                <span class="is-float-right ">{{ Auth::user()->store->translate()->store_name }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-phone"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.phone'):</span>  
                                <span class="is-float-right ">{{ Auth::user()->phone_number }}</span>
                            </li>
                        </ul>
                    </div>
                    <hr class="is-divider">
                    <h3 class="title is-size-5">@lang('user.pageRegister.label.bankInfo')</h3>
                    <div class="box-content">
                        <ul>
                            <li>
                                <span class="icon"><i class="fas fa-university"></i></span>
                                <span class="has-text-weight-bold">@lang('user.pageRegister.label.bankName'):</span>  
                                <span class="is-float-right ">{{ Auth::user()->bank_name }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-money-check"></i></span> 
                                <span class="has-text-weight-bold">@lang('user.pageRegister.label.bankCard'):</span> 
                                <span class="is-float-right">{{ Auth::user()->bank_number }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-map-marker"></i></span> 
                                <span class="has-text-weight-bold">@lang('user.pageRegister.label.bankAddress'):</span> 
                                <span class="is-float-right ">{{ Auth::user()->bank_address }}</span>
                           
                            </li>
                          
                        </ul>
                    </div>
                    <hr class="is-divider">
                    <h3 class="title is-size-5">@lang('user.survey.title')</h3>
                    <div class="box-content">
                       
                        <ul class="questionnaire__list">
                            @foreach($questionnaires as $key => $questionnaire)
                            @php 
                                $user = new UserCheck(Auth::user()->id, $questionnaire->id);
                            @endphp
                          
                            <li class="questionnaire__item">
                                <p class="questionnaire__title">{{ $questionnaire->translate()->title }}</p>
                                @if($user->is_Responsed())
                                    <span class="title is-size-5 has-text-danger">{{ $user->get_Response()->total_point }} @lang('user.survey.point')</span>
                                @else
                                <a class="button is-small is-success" href="{{ route('user.survey.detail', [app()->getLocale(), $questionnaire->id, Str::slug($questionnaire->translate()->title)]) }}">@lang('user.button.takesurvey')</a>
                                @endif
                               
                            </li>
                            @endforeach
                        </ul>
                 
                    </div>
            </div>
         
        </div>
    </div>
</section>
  
@endsection