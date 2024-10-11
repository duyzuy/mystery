@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <style>
        
        .list-info span.label{
            width: 180px;
            font-weight: bold;
            display: inline-block;
         

        }
        .list-info li{
            margin-bottom: 10px;
            list-style-type: none !important;
            display: flex
        }
        .list-info li p{
           flex: 1;
        }
    </style>

@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>{{ $survey->questionnaire->translate()->title }}</h2>
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
                    
                    <div class="col-12">
                        
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-info">
                                    <li><span class="label">Brand:</span> <p>{{ $survey->brand->name }}</p> </li>
                                    <li><span class="label">Restaurant:</span> <p>{{ $survey->store->translate()->store_name }}</p></li>
                                    <li><span class="label">Total point result:</span> <p>{{ $survey->total_point }}</p></li>
                                    <li><span class="label">Manager:</span> <p>{{ $survey->manager_name }}</p></li>
                                    <li><span class="label">Staff:</span> <p>{{ $survey->staff_name }}</p></li>
                                    <li><span class="label">Other comment:</span> <p>{{ $survey->feedback }}</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <table id="tableData" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th width="60%">Questions</th>
                                        <th>Answer</th>
                                        <th>Point</th>
                                        <th>Comment</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($survey->responses as $key => $response)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $response->question->question }}</td>
                                            <td width="240px">{{ $response->answer->answer }}</td>
                                            <td width="60px">{{ $response->point }}</td>
                                            <td>{{ $response->descriptions }}</td>
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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



@endpush
