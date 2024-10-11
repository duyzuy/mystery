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
    . h1{
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
                        <h1 class="has-text-white">Thank you for your confirmation</h1>
                        @lang('page.thank.content')
                    </div>
                </div>
            </div>
           
        </div>
    </div>
   
</section>
   
@endsection