@extends('frontend.master')

@push('styles')
<link href="{{ asset('css/frontend/owlcarousel/owl.theme.default.css') }}" rel="stylesheet">
<link href="{{ asset('css/frontend/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">

@endpush
@section('content')
<section id="slider">
    <div class="wrap-slider top__slider">
        <div class="overlay">
            <div id="slider__over" class="content slogan"  data-relative-input="true">
                <h3 class="is-size-1 is-uppercase has-text-centered has-text-white text__layer" data-speed="-6" data-depth="0.3">@lang('page.slogan.title')</h3>
                <p class="is-size-6 sub is-uppercase has-text-centered has-text-white text__layer" data-speed="-3" data-depth="0.2">@lang('page.slogan.sub')</p>
            </div>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach($sliders as $key => $slider)
                <div class="item">
                    <img src="{{ asset('storage/slider/' . $slider->slug) }}" alt="{{ $slider->name }}">
                </div>
            @endforeach
        </div>
        <div class="animation__area">
            <ul class="box__area">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
     
    </div>
</section>
<section class="section section_1">
    @php
                
    $data = json_decode($section1->translate()->setting_value, true);
    
    @endphp
    <div class="container m-b-50">
        <div class="header-section">
            <h4 class="is-size-3 has-text-centered mb-3 is-uppercase">{!! $data['title']  !!}</h4>
        </div>
        <div class="content-section">
            <div class="columns is-centered">
                <div class="column is-8">
                    <p class="has-text-centered">
                       {!! $data['content']  !!}
                    </p>
                    
                </div>
            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="header-section">
            <h4 class="title is-size-5 has-text-centered mb-5">@lang('page.homePage.howItWork')</h4>
        </div>
        <div class="content-section">
            <div class="wrap-slider boxes__work boxes-flow-work ">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="box">
                            <div class="box-image">
                                <img src="{{ asset('images/phone.png') }}" />
                            </div>
                            <div class="box-content">
                                <h4 class="label is-size-5">@lang('page.homeContent.howItWork.title_1')</h4>
                                <p>@lang('page.homeContent.howItWork.content_1')</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="box-image">
                                <img src="{{ asset('images/cutlery.png') }}" />
                            </div>
                            <div class="box-content">
                                <h4 class="label is-size-5">@lang('page.homeContent.howItWork.title_2')</h4>
                                <p>@lang('page.homeContent.howItWork.content_2')</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="box-image">
                                <img src="{{ asset('images/pointer.png') }}" />
                            </div>
                            <div class="box-content">
                                <h4 class="label is-size-5">@lang('page.homeContent.howItWork.title_3')</h4>
                                <p>@lang('page.homeContent.howItWork.content_3')</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="box-image">
                                <img src="{{ asset('images/questionmark.png') }}" />
                            </div>
                            <div class="box-content">
                                <h4 class="label is-size-5">@lang('page.homeContent.howItWork.title_4')</h4>
                                <p>@lang('page.homeContent.howItWork.content_4')</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="box">
                            <div class="box-image">
                                <img src="{{ asset('images/coin.png') }}" />
                            </div>
                            <div class="box-content">
                                <h4 class="label is-size-5">@lang('page.homeContent.howItWork.title_5')</h4>
                                <p>@lang('page.homeContent.howItWork.content_5')</p>
                            </div>
                        </div>
                    </div>
                 
                   
                </div>
            </div>           
        </div>
    </div>
</section>

<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <div class="header-section m-t-25 m-b-30">
                <h3 class="has-text-centered is-size-2 mb-3 is-uppercase">@lang('page.homePage.whatWeneed')</h3>
                <h2 class="subtitle has-text-centered m-b-50">@lang('page.homePage.subWhat')</h2>
            </div>
           
            <div class="columns boxes-what m-b-50 is-centered">
                <div class="column is-3-tablet">
                    <div class="box has-text-centered">
                        <div class="box-image">
                            <img src="{{ asset('images/man-typing.png') }}" alt="img">
                        </div>
                        <div class="box-content">
                            @lang('page.homeContent.whatWeneed.content_1')
                        </div>
                    </div>
                </div>
                <div class="column is-3-tablet">
                    <div class="box has-text-centered">
                        <div class="box-image">
                            <img src="{{ asset('images/detailed-observations.png') }}" alt="img">
                        </div>
                        <div class="box-content">
                            @lang('page.homeContent.whatWeneed.content_2')
                        </div>
                    </div>
                </div>
                <div class="column is-3-tablet">
                    <div class="box has-text-centered">
                        <div class="box-image">
                            <img src="{{ asset('images/by-phone.png') }}" alt="img">
                        </div>
                        <div class="box-content">
                            @lang('page.homeContent.whatWeneed.content_3')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section> 
<section id="section__store" class="section section-store">
    <div class="container">
        <div class="header-section m-t-25">
            <h4 class="is-size-3 has-text-centered is-uppercase">@lang('page.homePage.whereWe')</h4>
        </div>
        <div class="content-section">
            <div class="boxes-store">

                <div class="wrap__restaurent">
                    <restaurent 
                    :lang="getLang"
                    :translate="getTranslation"
                    ></restaurent> 
                </div>

            </div>
          
        </div>
  
    </div>
</section>

@endsection

@push('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/parallax.js') }}"></script>
    <script>

        const app = new Vue({
                el: '#app',
                data: {
                    lang: '{{ app()->getLocale() }}',
                    loading: false,
                    translate: {
                        option: '@lang('user.pageRegister.input.all')',
                        city: '@lang('page.storeCityTitle')',
                        store: '@lang('page.storeAdressTitle')',
                        view: '@lang('page.button.viewSite')',
                        labelAt: '@lang('user.pageRegister.label.all')'
                    }
                    
                },
                computed: {
                    getLang: function(){
                        return this.lang;
                    },
                    getTranslation: function(){
                        return this.translate
                    },
                },
               
            })

        var scene = document.getElementById('slider__over');
        var parallaxInstance = new Parallax(scene, {
            relativeInput: true
        });
        $('.top__slider .owl-carousel').owlCarousel({
            items:1,
            autoplay:true,
            animateOut: 'fadeOut'
        })
        $('.boxes__work .owl-carousel').owlCarousel({
            margin:10,
            autoplay:true,
            items:1,
            responsive:{
                420:{
                    items:1,
                    margin:20,
                },
                560:{
                    items:2,
                    margin:30,
                },
                768:{
                    items:3,
                    margin:20,
                },
                1240:{
                    items:4,
                    margin:40
                },
                1400:{
                    items:5,
                    margin:30
                }
            }
        })

    
        $('.nav-lang-mobile').on('click', function(){
            $(this).toggleClass('active');
        })
        
    </script>
@endpush