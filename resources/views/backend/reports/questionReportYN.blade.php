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
          <div class="col-12">
            <h1>{{ $questionnaire->translate('en')->title }}</h1>
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
                                      <option {{ $regionFilter == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
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
                                      <option {{ $brandFilter == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                        <option {{ $restaurant->id == $restaurantFilter ? 'selected' : '' }} value="{{ $restaurant->id }}">{{ $restaurant->translate()->store_name }}</option>
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
                                  <option {{ $answerType == 'yes' ? 'selected' : '' }} value="yes">Answer with "Yes" mark</option>
                                  <option {{ $answerType == 'no' ? 'selected' : '' }} value="no">Answer with "No" mark</option>
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
                  <div class="header-col mt-2 mb-3 text-right">
                    <a href="{{ route('manage.export.questions.filter', [$regionFilter, $brandFilter, $restaurantFilter, $dateFrom, $dateTo, $answerType]) }}" class="btn btn-info">Export</a>
                  </div>
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
  @php 
  $dateFrom = explode("-", $dateFrom);
  $dateTo = explode("-", $dateTo);
  $jsDateFrom = $dateFrom[2] . '/' . $dateFrom[1] . '/' .$dateFrom[0];
  $jsDateTo = $dateTo[2] . '/' . $dateTo[1] . '/' .$dateTo[0];

@endphp
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
        startDate: '{{ $jsDateFrom }}',
        endDate: '{{ $jsDateTo }}'
    })

</script>
@endpush