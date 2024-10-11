@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">



@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Top 10 Yes/No restaurants</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                     
                        <a href="{{ route('manage.export.top.restaurant', [$dateFrom, $dateTo, $answerType]) }}" class="btn btn-info btn-sm">Export</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-2 mt-2">
                       
                        <form action="{{ route('manage.top.restaurant') }}" method="POST">
                            @csrf
                            <div class="row">
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
                </div>
                <div class="row mb-2">
                    <!-- Default box -->
                      <div class="col-12">
                        @foreach($restaurants as $key => $restaurant)
                        <div class="card">
                            <div class="card-header">
                                Top: {{ $key + 1 }} - {{ $restaurant->translate('en')->store_name }}
                            </div>
                          <div class="card-body">
                              <ul class="list-group">
                                  <li class="list-group-item">
                                    <p class="bold is-bold">
                                        <span>Total say <span class="badge {{ $answerType == 'yes' ? 'badge-success' : 'badge-danger' }}">{{ $restaurant->key }}</span> - {{ $restaurant->resSum }}</span>
                                    </p>
                                  </li>
                              </ul>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        @endforeach
                     
                        <!-- /.card -->
                      </div>
        
                  </div>
                
            </div>
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


