@extends('frontend.master')

@section('content')
    <div class="container">
        @foreach($questionnaires as $key => $questionnaire)
        <div class="content">
            <h1>Survey</h1>
        </div>
        <ul>
            <li>{{ $questionnaire->translate()->title }} 
                <a href="{{ route('user.survey.detail', [app()->getLocale(), $questionnaire->id, Str::slug($questionnaire->translate()->title)]) }}">@lang('user.button.takesurvey')</a>
            </li>

        </ul>
        @endforeach
       
    </div>
@endsection