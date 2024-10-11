@extends('frontend.master')

@push('styles')

@endpush
@section('content')
<section class="section page-404">


    <div class="container">
        <div class="content has-text-centered">
            <h1 class="has-text-white has-text-centered" style="font-weight: 300">404</h1>
            <a href="{{ route('home', app()->getLocale()) }}" class="button button is-transparent has-text-white is-outlined"> Back to homepage</a>
        </div>
    </div>
</section>
   
@endsection