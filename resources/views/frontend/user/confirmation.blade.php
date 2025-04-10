@extends('frontend.master')

@section('title', 'Thank you')

<style>
    .header-page{
        background-image: url('../images/bg-guest-home.jpg');
        background-size: cover;
        background-position: top center;
        padding: 10rem 0 10rem;
        display: flex;
        align-items: center;
        justify-content: center
    }
    .h1{
        font-size: 10rem;
        opacity: .6;
    }

</style>


@section('content')
<section >
    <div class="header-page">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-7">
                    <div class="content has-text-centered has-text-white">
                        <h1 class="has-text-white">
                            @lang('page.confirmation.title')
                            </h1>
                        <p>@lang('page.confirmation.subTitle')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <div class="container">
    <div class="columns is-centered">
        <div class="column is-5 py-6 px-6">
            <div class="box border">
                    <div class="box-head mb-3">
                        <p class="has-text-centered is-size-4">
                            @lang('page.confirmation.boxTitle')
                        </p>
                    </div>
                    <hr/>
                    <div class="box-content">
                            @php
                            $checkin_date = Carbon\Carbon::create($userStore->check_in)->toDateTimeString();
                            $checkin_date = Carbon\Carbon::parse($checkin_date)->locale(app()->getLocale());
                            $checkin_date =  $checkin_date->isoFormat( app()->getLocale() == 'vi' ? 'dddd, Do MMMM, YYYY' : 'dddd, MMMM Do, YYYY'); 
                            @endphp
                        
                        <ul class="mb-3 fa-ul text-muted">
                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-utensils"></i></span> @lang('page.confirmation.storeName'): {{ $store->translate()->store_name }}</li>
                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span> @lang('page.confirmation.storeAddress'): {{ $store->translate()->store_address }}</li>
                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-clock"></i></span> @lang('page.confirmation.checkIn'): {{ app()->getLocale() == 'vi' ? "Trước" : "Before" }} {{ $checkin_date }}</li>
                        </ul> 
                        <form method="POST" action={{ route("user.made.confirmation", [app()->getLocale(), $userStore->token]) }}>
                            @csrf
                            <input type="hidden" value={{ $userStore->token }} name="token" />
                            <div class="field">                                 
                                <label class="radio" for="accept" style="color: green">
                                    <input id="accept" type="radio" name="answer" value="accept" />
                                    @lang('page.confirmation.confirmButton')
                                </label>
                            </div>
                            <div class="field" style="color: red">
                                <label class="radio">
                                    <input type="radio" name="answer" value="cancel" />
                                    @lang('page.confirmation.cancelButton')
                                </label>
                            </div>
                            @error('answer')
                                <p class="help is-danger mb-3">{{ $message }}</p>
                            @enderror
                            @error('token')
                                <p class="help is-danger mb-3">{{ $message }}</p>
                            @enderror
                            <div class="field">
                                <button class="button is-primary" type="submit">Xác nhận</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
   </div>
</section>
   
@endsection