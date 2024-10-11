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
                        <h1>Guest comment report</h1>
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
                    
                        <form action="{{ route('manage.report.guestComment.filter') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Questionaire</label>
                                        <select name="questionnaire" id="questionnaire" class="form-control form-control-sm @error('questionnaire') is-invalid @enderror">
                                            <option value="">Select questionnaire</option>
                                            @foreach ($questionnaires as $questionnaire)
                                                <option {{  $questionnaire->id == $questionnaireId ? 'selected': ''  }} value="{{ $questionnaire->id }}">{{ $questionnaire->translate('en')->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('questionnaire')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select name="region" id="region" class="form-control form-control-sm  @error('region') is-invalid @enderror">
                                            <option value="all">All</option>
                                            @foreach($regions as $key => $region)
                                                <option {{ $region->id == $regionFilter ? 'selected' : '' }}  value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Brand</label>
                                        <select name="brand" id="brand" class="form-control form-control-sm @error('brand') is-invalid @enderror">
                                            <option value="all">All brand</option>
                                            @foreach ($brands as $brand)
                                                <option {{  $brand->id == $brandFilter ? 'selected': ''  }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
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
                                <a href="{{ route('manage.export.guestcomment', [$regionFilter, $brandFilter, $dateFrom, $dateTo]) }}" class="btn btn-info">Export</a>
                            </div>
                            <div class="card-body">
                                   
                                    <table id="tableData" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="50px">ID</th>
                                            <th width="130px">Date</th>
                                            <th width="240px">Store Name</th>
                                            <th width="80px">Code</th>
                                            <th width="80px">Point</th>
                                            <th>Comment</th>
                                            <th width="50px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($surveys) != 0)
                                               
                                                @foreach($surveys as $key => $survey)
                                                
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ date('M j, Y', strtotime($survey->created_at)) }}</td>
                                                        <td>{{ $survey->store->translate('en')->store_name }}</td>
                                                        <td>{{ $survey->store->code }}</td>
                                                        <td>{{ $survey->total_point }}</td>
                                                        <td>{{ $survey->feedback }}</td>
                                                        <td>
                                                            <a class="btn btn-sm bg-gradient-success" href="{{ route('manage.survey.response.detail', $survey->id) }}">View</a>
                                                        </td>
                                                    </tr>
                                                  
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" align="center">No result</td>
                                                
                                                </tr>
                                            @endif
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
