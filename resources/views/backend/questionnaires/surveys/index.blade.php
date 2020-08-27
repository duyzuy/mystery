@extends('layouts.app')

@push('styles')
<link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
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
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1>Survey responses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">surveys</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            
            <!-- Default box -->
              <div class="col-12">

             
                
                <div class="card">
                  
                  <div class="card-body">
                    <table id="dataTable" class="table" data-page-length='25' style="font-size: 0.9rem">
                      <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">Name</th>
                                <th style="width: 25%">City</th>
                                <th style="width: 25%">Store</th>
                                <th style="width: 10%">Point</th>
                                <th style="width: 15%">Response time</th>
                                <th style="width: 10%"></th>
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
                                  <a href="{{ route('manage.survey.response.detail', $survey->id) }}" class="btn btn-sm bg-gradient-success">View detail</a>
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
@endsection
@push('scripts')

       
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/backend/demo.js') }}"></script>
    <script>
       
        $(function () {
    
            $('#dataTable').DataTable({
                "responsive": true,
              "autoWidth": false,
            });
        });


    function deleteStore(Id) {
 
        document.getElementById('store-'+Id).submit()
    }


</script>
@endpush