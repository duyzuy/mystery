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
                        <h1>Top 10 restaurant</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">report</li>
                        </ol>
                    </div>
                </div>
              
                <div class="row">
                    <!-- Default box -->
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
                </div>
            </div>
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
