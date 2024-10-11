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
            <h1>{{ $questionnaire->translate('en')->title }}</h1>
          </div>
          <div class="col-sm-6">
            <p class="float-sm-right">
              <a href="{{ route('manage.export.top.question', [$questionnaire->id, $filter]) }}" class="btn btn-info">Export</a>
            </p>
           </div>
        </div>
        <div class="row mb-2">
            
            <!-- Default box -->
              <div class="col-12">
                @foreach($questions as $key => $question)
                <div class="card">
                    <div class="card-header">
                        <span class="badge badge-success">Question: {{ $question->id }}</span> - {{ $question->translate('en')->question }}
                    </div>
                  <div class="card-body">
                      <ul class="list-group">
                       
                          <li class="list-group-item">
                            <p class="bold is-bold">
                                <span>Total say {{ $question->key }} - {{ $question->resSum }}</span>
                            </p>
                            {{-- <a href="{{ route('') }}" class="btn btn-primary btn-small">view detail</a> --}}
                          </li>
                 
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