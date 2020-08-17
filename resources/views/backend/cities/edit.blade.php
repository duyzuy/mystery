@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1292.07px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit city</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit city</li>
              <li></li>
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
                <h3 class="card-title">Edit city</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form novalidate="novalidate" method="POST" action="{{ route('manage.city.update', $city->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="viCityName">City name (Vietnamese)</label>
                    <input type="text" name="vi_city_name" class="form-control @error('vi_city_name') is-invalid @enderror" id="viCityName" value="{{ $city->translate('vi')->name }}">
                    @error('vi_city_name')
                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="enCityName">City name (English)</label>
                    <input type="text" name="en_city_name" class="form-control @error('en_city_name') is-invalid @enderror" id="enCityName" placeholder="City name (English)" value="{{ $city->translate('en')->name }}">
                    @error('en_city_name')
                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
