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
                <p class="is-size-6 sub is-uppercase has-text-centered has-text-white text__layer" data-speed="-3" data-depth="0.2">
                    @lang('page.slogan.sub')
                </p>
                <p class="sub is-uppercase has-text-centered has-text-white text__layer mt-5" data-speed="-3" data-depth="0.2">
                    <a class="button is-white is-outlined" style="pointer-events: all" href="{{ route('user.register', app()->getLocale()) }}"> @lang('user.register')</a>
                </p>
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
                <div class="column is-10">
                    <p class="has-text-centered">
                       {!! $data['content']  !!}
                    </p>
                    
                </div>
            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="header-section">
            <h4 class="title is-size-5 has-text-centered mb-5 is-uppercase">@lang('page.homePage.howItWork')</h4>
        </div>
        <div class="content-section">
            <div class="boxes__work boxes-flow-work ">
                <div class="box">
                    <a href="{{ route('user.register', app()->getLocale()) }}">
                        <div class="box-image">
                            <img src="{{ asset('images/phone.png') }}" />
                        </div>
                        <div class="box-content">
                            <h4 class="label is-size-6 is-uppercase">@lang('page.homeContent.howItWork.title_1')</h4>
                        </div>
                    </a>
                </div>

                <div class="box">
                    <div class="box-image">
                        <img src="{{ asset('images/cutlery.png') }}" />
                    </div>
                    <div class="box-content">
                        <h4 class="label is-size-6 is-uppercase">@lang('page.homeContent.howItWork.title_2')</h4>
                      
                    </div>
                </div>

                <div class="box">
                    <div class="box-image">
                        <img src="{{ asset('images/pointer.png') }}" />
                    </div>
                    <div class="box-content">
                        <h4 class="label is-size-6 is-uppercase">@lang('page.homeContent.howItWork.title_3')</h4>
                      
                    </div>
                </div>

                <div class="box">
                    <div class="box-image">
                        <img src="{{ asset('images/coin.png') }}" />
                    </div>
                    <div class="box-content">
                        <h4 class="label is-size-6 is-uppercase">@lang('page.homeContent.howItWork.title_4')</h4>
                        
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
                <div class="columns is-centered">
                    <div class="column is-8">
                        @if(app()->getLocale() == 'en')
                        <h3 class="has-text-centered is-size-2 mb-3 is-uppercase">What we need from you</h3>
                        <h2 class="subtitle has-text-centered m-b-20">You just need to meet the following basic requirements:</h2>
                            <div class="description">
                               <p>Visit the confirmed reservation restaurant without letting any staff know that you are a Mystery Diner.</p><br>
                               <p>While in the restaurant, you will pay attention to details such as:</p>
                                <ul style=" list-style-type: disc; padding-left: 30px;">
                                    <li>How clean is the restaurant?</li>
                                    <li>Did the staff welcome you as you entered the restaurant?</li>
                                    <li>How long did it take for your meal to arrive?</li>
                                    <li>Did your meal look delicious?</li>
                                    <li>Was it prepared to your liking? </li>
                                    <li>Was your meal tasty??</li>
                                    <li>and some other specific questions.</li>
                                    
                                </ul><br>
                                <p>After leaving the restaurant, simply fill out a simple questionnaire, describing your dining experience.</p><br>
                                <p>Usually, you will be able to bring a friend or even your family when you go the restaurant to complete Mystery Diner survey.</p>
                            </div>
        
                        @else
                        <h3 class="has-text-centered is-size-2 mb-3 is-uppercase">Chúng tôi cần gì từ bạn</h3>
                        <h2 class="subtitle has-text-centered m-b-20">Bạn chỉ cần đáp ứng yêu cầu cơ bản sau</h2>
                        <div class="description">
                            <p>Bạn sẽ ghé thăm nhà hàng mà không cho bất kỳ nhân viên nào biết rằng bạn là một Khách hàng Bí ẩn.</p><br>
                            <p>Khi ở trong nhà hàng, bạn sẽ chú ý đến các chi tiết như:</p>
                            <ul style=" list-style-type: disc; padding-left: 30px;">
                                <li>Địa điểm khảo sát sạch sẽ như thế nào?</li>
                                <li>Nhân viên có chào đón bạn khi bạn bước vào nhà hàng hay không?</li>
                                <li>Mất bao lâu để bữa ăn của bạn được phục vụ?</li>
                                <li>Bữa ăn nhìn có ngon miệng không?</li>
                                <li>Bữa ăn được chuẩn bị bắt mắt không?</li>
                                <li>Nó có ngon không?</li>
                                <li>... và hơn nữa.</li>
                            </ul>
                            <br>
                            <p>Sau khi rời nhà hàng, bạn chỉ cần điền vào một bảng câu hỏi đơn giản mô tả trải nghiệm ăn uống của mình.</p>
                            <br>
                            <p>Thông thường, bạn sẽ có thể dẫn theo một người bạn hoặc thậm chí cả gia đình làm khách của mình khi đi khảo sát nhà hàng.</p>
                        </div>
        
                        @endif
                    </div>
                </div>
                
             
            </div>
           
            <div class="columns boxes-what m-b-50 is-centered">
                <div class="column is-3-tablet">
                    <div class="box has-text-centered">
                        <div class="box-image">
                            <img src="{{ asset('images/girl-mystery.png') }}" alt="img">
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
                    <div class="field">
                        <div class="control store-select is-size-5">
                            <label for="city" class="is-bold mr-2 mb-0">@lang('user.pageRegister.label.all')</label>
                            <div class="select">
                                <select name="city" id="city" v-model="mCity"  class="form-control @error('city') is-invalid @enderror">
                                    <option value="">@lang('user.pageRegister.input.all')</option>
                                    @foreach($cities as $key => $city)
                                    <option value="{{ $city->id }}">{{ $city->translate()->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <restaurants 
                    :lang="getLang"
                    :translate="getTranslation"
                    :cityid="mCity"
                    ></restaurants> 
                </div>

            </div>
          
        </div>
  
    </div>
</section>

<section class="section__brand m-b-50">
    <div class="container">
        <div class="box-brands">
            <div class="brand-item">
                <a href="https://alfrescos.com.vn/" target="_blank">
                    <img src="{{ asset('images/brand-1.png') }}" />
                </a>
            </div>
            <div class="brand-item">
                <a href="https://pepperonis.com.vn/" target="_blank">
                    <img src="{{ asset('images/brand-6.png') }}" />
                </a>
            </div>
            <div class="brand-item">
                <a href="https://jaspas.com.vn/" target="_blank">
                    <img src="{{ asset('images/brand-3.jpg') }}" />
                </a>
            </div>
            <div class="brand-item">
                <a href="https://www.jacksons-steakhouse.com/cms/" target="_blank">
                    <img src="{{ asset('images/brand-2.png') }}" />
                </a>
            </div>
           
            <div class="brand-item">
                <a href="" target="_blank">
                    <img src="{{ asset('images/brand-5.png') }}" />
                </a>
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
                    mCity: "",
                    translate: {
                        view: '@lang('page.button.viewSite')',
                    }
                },
                methods: {

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

        $('.nav-lang-mobile').on('click', function(){
            $(this).toggleClass('active');
        })
        
    </script>
@endpush