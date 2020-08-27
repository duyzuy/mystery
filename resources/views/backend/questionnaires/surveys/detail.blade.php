@extends('layouts.app')

@push('styles')

  <style>
 
  </style>
@endpush
@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Response detail</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Response detail</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
    
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                
    
                    <h3 class="profile-username text-center mb-3">{{ $survey->user->name }}</h3>
    
    
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $survey->user->email }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Phone</b> <a class="float-right">{{ $survey->user->phone_number }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Address</b> <a class="float-right">{{ $survey->user->address }}</a>
                      </li>
                    </ul>
                    <a href="{{ route('manage.survey.responses') }}" class="btn btn-danger btn-block">Back</a>
                  </div>
                  
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Survey detail</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-file-alt mr-1"></i> Questionnaire</strong>
    
                    <p class="text-muted">
                        {{ $survey->questionnaire->title }}
                    </p>
    
                    <hr>
                    <strong><i class="fas fa-utensils mr-1"></i> Store</strong>
                    <p class="text-muted mb-0">Region: {{ $survey->store->city->region->name }}</p>
                    <p class="text-muted mb-0">City: {{ $survey->store->city->name }}</p>
                    <p class="text-muted mb-0">Store: {{ $survey->store->store_name }}</p>
                    <p class="text-muted">Address: {{ $survey->store->store_address }}</p>
                    <hr>
                    <strong><i class="fas fa-qrcode mr-1"></i> Information payment</strong>
                    <ul class="list-group list-group-unbordered mb-3">
                        
                        <li class="list-group-item text-muted" style="border-top: none">
                          <b>Bank name</b> <a class="float-right">{{ $survey->bank_name }}</a>
                        </li>
                        <li class="list-group-item text-muted">
                          <b>Card number</b> <a class="float-right">{{ $survey->bank_number }}</a>
                        </li>
                        <li class="list-group-item text-muted">
                          <b>Bank address</b> <a class="float-right">{{ $survey->bank_address }}</a>
                        </li>
                        <li class="list-group-item text-muted">
                            <b>Receipt code</b> <a class="float-right">{{ $survey->receipt_number }}</a>
                        </li>
                        <li class="list-group-item text-muted" style="border-bottom: none">
                            @php
                                $dinnerTime = new TimeFormat($survey->dinner_time)   
                            @endphp
                            <b>Dinner time</b> <a class="float-right">{{ $dinnerTime->getTime() }}</a>
                        </li>
                      </ul>
                   
                    <hr>
                    <strong><i class="far fa-comment-dots"></i> Feedback</strong>
                    <p class="text-muted">{{ $survey->feedback }}</p>
                    <hr>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Response detail</h3>
                  </div><!-- /.card-header -->
                  <div class="card-body" style="font-size: .9rem">
                    <table class="table ta table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 45%">
                                    Question name
                                </th>
                                <th style="width: 14%">
                                    Answer
                                </th>
                                <th style="width: 40%">
                                    Feedback
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($survey->responses as $key => $respponse)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $respponse->question->question }}</td>
                                <td>{{ $respponse->answer->answer }}</td>
                                <td>{{ $respponse->descriptions }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

  </div>
@endsection
@push('scripts')

       
  
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