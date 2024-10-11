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
                        <h1>Brand report 1</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brand report</li>
                        </ol>
                    </div>
                </div>
              
                <div class="row">
                    <!-- Default box -->
                    <div class="col-12 mb-2 mt-2">
                        <form action="{{ route('manage.report.brand.yn.filter') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Questionaire</label>
                                        <select name="questionnaire" id="questionnaire" class="form-control form-control-sm @error('questionnaire') is-invalid @enderror">
                                            <option value="">Select questionnaire</option>
                                            @foreach ($questionnaires as $questionnaire)
                                                <option {{ $questionnaireId == $questionnaire->id ? 'selected' : '' }} value="{{ $questionnaire->id }}">{{ $questionnaire->translate('en')->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('questionnaire')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select name="region" id="region" class="form-control form-control-sm  @error('region') is-invalid @enderror">
                                            <option value="all">All</option>
                                            @foreach($regions as $key => $region)
                                                <option {{ $region->id == $regionFilter ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Brand:</label>
                                        <select name="brand" id="brand" class="form-control form-control-sm @error('brand') is-invalid @enderror">
                                            <option value="">Select brand</option>
                                            @foreach($brands as $brand)
                                            <option {{ $brandReport->id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
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
                                <div class="col d-flex align-items-end">
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                  
                                        <p class="mb-0">Brand: {{ $brandReport->name }}  </p>
                                        <p>From: {{  $dateFrom }} to {{ $dateTo }}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="mb-0 text-right">
                                            <a href="{{ route('manage.export.brandYn', [$regionFilter, $brandReport->id, $dateFrom, $dateTo]) }}" class="btn btn-info">Export</a>
                                        </p>
                                    </div>
                                </div>
                               
                               
                            </div>
                            <div class="card-body backend-report">
                                <div class="wrap__report d-flex">
                                <div>
                                    <table class="table table-bordered dataTable no-footer dtr-inline table-report">
                                        <thead>
                                            <tr>
                                                <td>Questions</td>
                                                <td>Yes</td>
                                                <td>No</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                                $chars = ['a', 'b', 'c', 'd'];
                                            @endphp
                                            @foreach($groupQuestions as $key => $group)
                                                <tr style="background: #f8d3d6">
                                                    <td colspan="3">{{ $group->title }}</td>
                                                </tr>
                                                
                                                @foreach($group->questions as $question)
                                                @php
                                                    $i++;
                                                @endphp
                                                    @if($question->type == 'yn')
                                                    <tr>
                                                        <td>{{ $i }} . {{ $question->question }}</td>
                                                        <td align="center" style="vertical-align: middle;">{{ round(@($question->responseSum[0]->yes_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                                                        <td align="center" style="vertical-align: middle;">{{ round(@($question->responseSum[0]->no_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td colspan="3">{{ $i }} . {{ $question->question }}</td>
                                                    </tr>
                                                        @foreach($question->answers as $answer_key => $answer)
                                                            <tr>
                                                                <td>{{ $chars[$answer_key] . ' . ' . $answer->translate()->answer }}</td>
                                                                @if($answer_key == 0)
                                                                    <td align="center" style="vertical-align: middle;" colspan="2">{{ round(@($question->responseSum[0]->answer1_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                                                                @elseif($answer_key == 1)
                                                                    <td align="center" style="vertical-align: middle;" colspan="2">{{ round(@($question->responseSum[0]->answer2_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                                                                @else
                                                                    <td align="center" style="vertical-align: middle;" colspan="2">{{ round(@($question->responseSum[0]->answer3_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                  
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <tr>

                                            </tr>
                                        
                                           
                                        </tbody>
                                        <tfoot>
                                           
                                         </tfoot>
                                    </table>
                                </div>
                              
                            </div>
                            <!-- /.card-body -->
                        </div>
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
