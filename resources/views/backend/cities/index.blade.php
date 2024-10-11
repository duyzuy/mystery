@extends('layouts.app')

@push('styles')

<link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper" style="min-height: 1292.07px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cities</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cities</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add new city</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('manage.city.store') }}">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="region">Region</label>
                        <select class="form-control @error('region') is-invalid @enderror" name="region" style="width: 100%;">
                          <option value="">Select region</option>
                          @foreach($regions as $region)
                            <option {{ old('region') == $region->id ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
                          @endforeach
                        </select>
                        @error('region')
                          <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="viCityName">City name (Vietnamese)</label>
                        <input type="text" name="vi_city_name" class="form-control @error('vi_city_name') is-invalid @enderror" value="{{ old('vi_city_name') }}" id="viCityName" placeholder="City name (vietnamese)">
                        
                        @error('vi_city_name')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <!--endcol-->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="enCityName">City name (English)</label>
                        <input type="text" name="en_city_name" class="form-control @error('en_city_name') is-invalid @enderror" value="{{ old('en_city_name') }}" id="enCityName" placeholder="City name (English)">
                        @error('en_city_name')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <!--endrow-->
                 
            
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Create new city</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <div class="city_list">
                
            </div>
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Cities list</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="citiesdata" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>City Name (VI)</th>
                      <th>City Name (EN)</th>
                      <th>Region</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      
                        @foreach($cities as $key => $city)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $city->translate('vi')->name }}</td>
                            <td>{{ $city->translate('en')->name }}</td>
                            <td>{{ $city->region->translate('en')->name }}</td>
                           
                            <td><a href="{{ route('manage.city.edit', $city->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="deleteCity({{ $city->id }})"><i class="fas fa-trash"></i> Delete</a>
                                <form id="city-{{ $city->id }}" action="{{ route('manage.city.delete', $city->id )}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                        </td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>City Name (VI)</th>
                        <th>City Name (EN)</th>
                        <th>Region</th>   
                        <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
                
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    
            $('#citiesdata').DataTable({
                "responsive": true,
            "autoWidth": false,
            });
        });


        function deleteCity(cityId, name) {

          Swal.fire({
            title: 'Delete Brand',
            text: "if Yes, all Resraurent are related this city will be deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete all!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                
                'Deleted!',
                'Your file has been deleted.',
                'success',
                document.getElementById('city-'+cityId).submit()
                
              )
            }
          })
            
        }
 
 



    </script>
@endpush