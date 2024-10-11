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
                        <h1>Registrations report</h1>
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
                        <form action="{{ route('manage.registered.date.report') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Questionaire</label>
                                        <select name="questionnaire" id="questionnaire" class="form-control form-control-sm @error('brand') is-invalid @enderror">
                                            <option value="">Select questionnaire</option>
                                            @foreach ($questionnaires as $questionnaire)
                                                <option value="{{ $questionnaire->id }}">{{ $questionnaire->translate('en')->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('questionnaire')
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
                                <a href="{{ route('manage.export.registrations') }}" class="btn btn-info">Export</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                     <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Day of birth</th>
                                        <th>Register at</th>
                                        <th>Outlet</th> 
                                        <th>Restaurant Confirmed</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                     </tr>
                                    </thead>
                                     <tbody>
                                
                                         @foreach($data as $key => $d)
                                            @php $numberRestaurant = count($d['user']->userRestaurents); @endphp
                                            <tr>
                                                <td rowspan="{{ $numberRestaurant }}">{{ $d['user']->id }}</td>
                                                <td rowspan="{{ $numberRestaurant }}">{{ $d['user']->name }}</td>
                                                <td rowspan="{{ $numberRestaurant }}">{{ $d['user']->email }}</td>
                                                <td rowspan="{{ $numberRestaurant }}">{{ $d['user']->phone_number }}</td>
                                                <td rowspan="{{ $numberRestaurant }}">{{ $d['user']->day_of_birth }}</td>
                                               
                                                @foreach($d['restaurants'] as $restaurant)
                                                    <td>{{ $restaurant['register_at'] }}</td>
                                                    <td>
                                                        @foreach($restaurant['stores'] as $store)
                                                            {{ $store->translate('en')->store_name }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($restaurant['stores'] as $store)
                                                            @if($store->id == $restaurant['store_id'])
                                                            {{ $store->translate('en')->store_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $restaurant['check_in'] }}
                                                    </td>
                                                    <td>
                                                        {{ $restaurant['response_status'] }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tr>
                                         @endforeach
                                     </tbody>
                                 </table>
                            </div>
                        </div>
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
