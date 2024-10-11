@extends('frontend.master')

@section('title', 'Profile')
@push('styles')
 
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
@section('content')
<section class="hero is-primary header-profile">
    <div class="header-section">
        <div class="hero-body">
            <div class="container has-text-centered wrap__name">
              <h1 class="title is-uppercase has-text-centered name is-size-5">
                {{ Auth::user()->name }}
              </h1>
            </div>
          </div>
    </div>
</section>
<section class="section profile">
    <div class="container">
        <div class="columns is-centered is-desktop">
            <div class="column is-4">
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
                                <span class="icon"><i class="fas fa-phone"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.phone'):</span>  
                                <span class="is-float-right ">{{ Auth::user()->phone_number }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.address'):</span> 
                                <span class="is-float-right ">{{ Auth::user()->address }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-birthday-cake"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.birthDay'):</span> 
                                <span class="is-float-right ">{{  Auth::user()->day_of_birth }}</span>
                            </li>
                            <li>
                                <span class="icon"><i class="fas fa-venus-mars"></i></span>
                                <span class="has-text-weight-bold">@lang('user.profile.gender'):</span> 
                                <span class="is-float-right is-capitalized">{{  Auth::user()->gender }}</span>
                            </li>
                        </ul>
            
                    </div>
                   
                </div>
               
                
            </div>
            <div class="column is-8">
                <div class="box box-registration-store">

                
                    
                    <h3 class="title is-size-5">@lang('user.profile.registerTitle')</h3>
                    <hr class="is-divider">
                    <div class="box-content">
                        @foreach($storeRegistrations as $key => $storeRegistration)
                        <div class="store__registration  mb-5">
                            <div class="mb-3">@lang('user.profile.registration') {{ $key + 1 }}</div>
                                <div class="columns">
                                @foreach($storeRegistration['stores'] as $store)
                                    <div class="column {{ $storeRegistration['store_id'] === $store->id ? 'chosed' : '' }}">
                                        <div class="card">
                                         
                                            <div class="card-content">
                                              <div class="content">
                                                <ul class="mb-3 fa-ul text-muted">
                                                    <li  class="mb-2"><span class="fa-li"><i class="fas fa-university"></i></span> @lang('user.profile.region'): {{ $store->city->region->translate()->name }}</li>
                                                    <li  class="mb-2"><span class="fa-li"><i class="fas fa-building"></i></span> @lang('user.profile.city'): {{ $store->city->translate()->name }}</li>
                                                    <li  class="mb-2"><span class="fa-li"><i class="fas fa-leaf"></i></span> @lang('user.profile.brand'): {{ $store->brand->name }}</li>
                                                    <li  class="mb-2"><span class="fa-li"><i class="fas fa-utensils"></i></span> @lang('user.profile.restaurant'): {{ $store->translate()->store_name }}</li>
                                                    {{-- <li><time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time></li> --}}
                                                </ul> 
                                                @if($storeRegistration['store_id'] === $store->id)
                                                    <i class="fas fa-check"></i>
                                                @endif
                                              </div>
                                            </div>
                                          </div>

                                         
                                    </div>
                                @endforeach
                                </div>

                        
                      
                            {{-- <h3 class="title is-size-5">@lang('user.survey.title')</h3> --}}
                            <div class="box-content">
                            
                                <ul class="questionnaire__list">
                                    @foreach($questionnaires as $key => $questionnaire)
                                        @php 
                                            $user = new UserCheck(Auth::user()->id, $questionnaire->id, $storeRegistration['index']);
                                        @endphp
                                        @if($user->is_admin_confirmed())

                                            @if($user->email_response() === 'waiting')
                                                <p>@lang('user.profile.statusWaitting')</p>

                                            @elseif($user->email_response() === 'canceled')
                                            
                                                <p style="color: red">@lang('user.profile.statusCancel')</p>

                                            @elseif($user->email_response() === 'accepted')
                                                <li class="questionnaire__item">
                                                    {{-- <p class="questionnaire__title">{{ $questionnaire->translate()->title }}</p> --}}
                                                    @if($user->is_Responsed())
                                                        {{-- <span class="title is-size-5 has-text-danger">{{ $user->get_Response()->total_point }} @lang('user.survey.point')</span> --}}
                                                        <span class="icon is-large has-text-success"><i class="fas fa-check"></i></span>
                                                    @else
                                                        <a class="button is-small is-theme" style="background-color: #f15a22; color: #fff; border-radius: 5px; border: none" href="{{ route('user.survey.detail', [app()->getLocale(), $questionnaire->id, Str::slug($questionnaire->translate()->title), $storeRegistration['index']]) }}">@lang('user.button.takesurvey')</a>
                                                    
                                                    @endif
                                                
                                                </li>
                                            @else
                                                <p>@lang('user.profile.statusCompleted')</p>
                                            @endif
                                        @else
                                            <p>Your registration is waiting for confirm from admin</p>
                                        @endif
                                        
                                    @endforeach
                                </ul>
                        
                            </div>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
</section>
  
@endsection
