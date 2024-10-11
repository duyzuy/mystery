@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1292.07px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>brands</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
                <h3 class="card-title">Edit brand</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('brands.update', $brand->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="viCityName">Brand name</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{ $brand->name }}" placeholder="Brand name">
                        
                        @error('brand_name')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <!--endcol-->
                  </div>
                  <!--endrow-->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('brands.index') }}" class="btn btn-danger mr-2">Cancel</a>
                  <button type="submit" class="btn btn-success">Update</button>
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
