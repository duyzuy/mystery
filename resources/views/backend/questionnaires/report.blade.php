@extends('layouts.app')

@push('styles')
  <style>
    .answer__group{
      display: flex
    }
    .answer__group .answer{
      flex: 1;
      max-width: 370px;
      padding-right: 20px
    }
    .responses{
      flex: 1;
      max-width: 220px;
    }
  </style>
@endpush
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1>Questionnairs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Questionnairs</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            
            <!-- Default box -->
              <div class="col-12">
                @foreach($questionnaires as $key => $questionnaire)
                <div class="card">
                  <div class="card-header">{{ $questionnaire->translate('en')->title }}</div>
                  <div class="card-body">
                      <ul class="list-group">
                        @foreach($questionnaire->questions as $key => $question)
                          <li class="list-group-item">
                            <p class="bold is-bold"> <span>{{ $key+1 }}. </span>{{ $question->translate('en')->question }}</p>
                           
                              <ul class="list-group">
                              @foreach($question->answers as $answer)
                                <li class="list-group-item answer__group">
                                  <p class="answer" style="margin-bottom: 0">{{ $answer->translate('en')->answer }}</p>
                                  <div class="responses">
                                    <div class="response__count">{{ $answer->responses->count() .'/'. $question->responses->count() }}
                                    </div>
                                    <div class="progress progress-xs">
                                      @if($answer->key == 'yes')
                                        <div class="progress-bar bg-success" style="width: {{ ($answer->responses->count()/$question->responses->count())*100 }}%"></div>
                                      @elseif($answer->key == 'no')
                                        <div class="progress-bar bg-warning" style="width: {{ ($answer->responses->count()/$question->responses->count())*100 }}%"></div>
                                      @else
                                        <div class="progress-bar bg-primary" style="width: {{ ($answer->responses->count()/$question->responses->count())*100 }}%"></div>
                                      @endif
                                    
                                    </div>
                                  </div>
                                </li>
                              @endforeach
                              </ul>
                          </li>
                        @endforeach
                      </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
              @endforeach
             
                <!-- /.card -->
              </div>

          </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection
@push('scripts')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
{{-- <script src="{{ asset('js/backend/demo.js') }}"></script> --}}
<script src="{{ asset('js/backend/pages/dashboard3.js') }}"></script>
@endpush