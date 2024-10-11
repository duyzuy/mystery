@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
            <div class="col-12 mb-3">
              <form action="{{ route('manage.questions.report.filter') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col col-md-6 col-lg-2">
                        <div class="form-group">
                            <label>Region</label>
                            <select name="region" id="region" class="form-control form-control-sm  @error('region') is-invalid @enderror">
                                <option value="all">All</option>
                                @foreach($regions as $key => $region)
                                    <option {{ old('region') == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
                                @endforeach
                            </select>
                            @error('region')
                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-6 col-lg-2">
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand" id="brand" class="form-control form-control-sm  @error('brand') is-invalid @enderror">
                                <option value="all">All</option>
                                @foreach($brands as $key => $brand)
                                    <option {{ old('brand') == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand')
                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col col-md-6 col-lg-2">
                      <div class="form-group">
                          <label>Restaurants</label>
                          <select name="restaurant" id="restaurant" class="form-control form-control-sm  @error('restaurant') is-invalid @enderror">
                              <option value="all">All</option>
                              @foreach($cities as $city)
                                <optgroup label="{{ $city->translate()->name }}">
                                  @foreach($city->stores as $key => $restaurant)
                                      <option {{ old('restaurant') == $restaurant->id ? 'selected' : '' }} value="{{ $restaurant->id }}">{{ $restaurant->translate()->store_name }}</option>
                                  @endforeach
                                </optgroup>
                              @endforeach
                          </select>
                          @error('restaurant')
                              <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                          @enderror
                      </div>
                    </div>
                    <div class="col col-md-6 col-lg-2">
                            <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="date" class="form-control form-control-sm float-right @error('date') is-invalid @enderror" id="reservation">
                                    @error('date')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- /.input group -->
                            </div>
                  
                    </div>
                    <div class="col col-md-6 col-lg-2">
                        <div class="form-group">
                            <label>Answer mark for report:</label>
                            <select name="answer_type" id="typeanswer" class="form-control form-control-sm @error('answer_type') is-invalid @enderror">
                                <option value="">Select Answer type</option>
                                <option value="yes">Answer with "Yes" mark</option>
                                <option value="no">Answer with "No" mark</option>
                            </select>
                            @error('answer_type')
                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col d-flex align-items-end">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Filter</button>
                        </div>
                       
                    </div>
                </div>
              </form>
            </div>
            <!-- Default box -->
              <div class="col-12">
               
                <div class="card">
                  <div class="card-header">{{ $questionnaire->translate('en')->title }}
                    {{-- <a href="{{ route('manage.questionnaire.report.filter', [$questionnaire->id, 'no']) }}" class="btn btn-info float-right btn-sm ml-2">Top say no</a>
                    <a href="{{ route('manage.questionnaire.report.filter', [$questionnaire->id, 'yes']) }}" class="btn btn-info float-right btn-sm">Top say yes</a> --}}
                  </div>
                  <div class="card-body">
                      <ul class="list-group">
                        @foreach($questionnaire->questions as $key => $question)
                          <li class="list-group-item">
                            <p class="bold is-bold"> <span>{{ $key+1 }}. </span>{{ $question->translate('en')->question }}</p>
                              <ul class="list-group">
                                {{-- @foreach($question->responses as $response)

                                  {{ $response->survey->user->name }}
                                    
                                @endforeach  --}}
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
            
             
                <!-- /.card -->
              </div>

          </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection
@push('scripts')
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>



<script>
    $('#reservation').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        maxDate: new Date(),
        
    })

</script>
@endpush
