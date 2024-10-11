@extends('layouts.app')

@push('styles')
<link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
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
    #dataTable{
      margin-left: -20px;
      margin-right: -20px;
   
      border-bottom: 1px solid #f1f1f1;
      margin-bottom: 20px !important;
    }
    .table td, .table th{
      border-color: #f1f1f1;
    }
    .table thead th{
      border-bottom-width: 0;
    }
    .table tr.not_view{
      background: #fffce3;
    }
    .table tr.not_view > td:first-child{
      border-left: 2px solid red;
    }
    /* .table tr.viewed > td:first-child{
      border-left: 2px solid #04cd04;
    } */
  </style>
@endpush
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-sm-6">
            <h1>Survey responses</h1>
          </div>
          {{-- <div class="col-sm-6">
            <p class="float-sm-right">
              <a href="{{ route('manage.export.user.all.bill') }}" class="btn btn-info">Export all bill</a>
            </p>
           </div> --}}
        </div>
        <div class="row mb-2">
            <div class="col-12 mb-2 mt-2">         
                <form action="{{ route('manage.survey.response.filter') }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col col-md-6 col-lg-2">
                            <div class="form-group">
                                <label for="">Questionaire</label>
                                <select name="questionnaire" id="questionnaire" class="form-control form-control-sm @error('questionnaire') is-invalid @enderror">
                                    <option value="">Select questionnaire</option>
                                    @foreach ($questionnaires as $questionnaire)
                                        <option {{ $questionnaireId == $questionnaire->id ? 'selected' : '' }}  value="{{ $questionnaire->id }}">{{ $questionnaire->translate('en')->title }}</option>
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
                                        <option {{ $regionId == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
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
                                        <option {{ $brandId == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                            <option {{ $restaurant->id == $restaurantId ? 'selected' : '' }} value="{{ $restaurant->id }}">{{ $restaurant->translate()->store_name }}</option>
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
                    <div class="card-header text-right">
                        <a href="{{ route('manage.export.user.filter.bill', [$regionId, $brandId, $restaurantId, $dateFrom, $dateTo]) }}" class="btn btn-info">Export Bill</a>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table" data-page-length='25' style="font-size: 0.9rem">
                            <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Name</th>
                                        <th style="width: 15%">City</th>
                                        <th style="width: 20%">Store</th>
                                        <th style="width: 10%">Point</th>
                                        <th style="width: 15%">Response time</th>
                                        <th style="width: 20%"></th>
                                    </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($surveys as $key => $survey)
                                    <tr class="12 {{ $survey->viewed == 0 ? 'not_view' : 'viewed' }}">
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $survey->user->name }}</td>
                                        <td> {{ $survey->store->city->name }}</td>
                                        <td> {{ $survey->store->store_name }}</td>
                                        <td> <span class="badge badge-success">
                                        {{ $survey->total_point }} point
                                        </span>  </td>
                                        <td> <div class="time">
                                            @php
                                                $responseTime = new TimeFormat($survey->created_at)   
                                            @endphp
                                            <span class="response__time d-block">
                                                
                                                {{ $responseTime->getTime() }}
                                            
                                            </span>
                                            <span class="human__time" style="font-size: 0.9">
                                                
                                                {{ $responseTime->diffForHuman() }}
                                            
                                            </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('manage.survey.response.detail', $survey->id) }}" class="btn btn-outline-primary btn-sm mr-2">View</a>
                                            <a href="{{ route('manage.export.response', $survey->id) }}" class="btn btn-outline-info btn-sm">Export</a>
                                            <a href="{{ route('manage.survey.edit', [$survey->user->id, $survey->id]) }}" class="btn btn-outline-danger btn-sm">Edit</a>
                                        </td>
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

       
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('js/backend/demo.js') }}"></script>
    <script>
        $('#reservation').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxDate: new Date(),
            startDate: '{{ $jsDateFrom }}',
            endDate: '{{ $jsDateTo }}'
          
      })

        $(function () {
    
            $('#dataTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[ 5, "desc" ]]
            });
        });


    function deleteStore(Id) {
 
        document.getElementById('store-'+Id).submit()
    }


</script>
@endpush
