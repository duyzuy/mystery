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
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">Add new slider</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('manage.slider.update', $slider->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Slider name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $slider->name }}" id="name" placeholder="Slider name">
                        
                        @error('name')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group @error('image') is-invalid @enderror">
                        <label for="image">Store image</label>
                        <div class="image-preview">
                            @if($slider->slug != 'default.jpg')
                                <td>
                                    <img src="{{ asset('storage/slider/' . $slider->slug) }}" style="width: 100px; height: 100px; object-fit: cover" alt="{{ $slider->name }}"/>
                                </td>
                            @else
                                <td>
                                    <img src="{{ asset('images/default.jpg') }}" style="width: 100px; height: 100px; object-fit: cover" alt="{{ $slider->name }}"/>
                                </td>
                            
                            @endif
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" value="{{ $slider->slug }}">
                                @error('image')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                <label class="custom-file-label" for="image">{{ $slider->slug }}</label>
                            
                            </div>
                        </div>
                       
                    </div>
                    <div class="form-group">
                        <label for="sort">Sort</label>
                        <input type="number" name="sort" class="form-control @error('sort') is-invalid @enderror" value="{{ $slider->sort }}" id="sort" placeholder="Sort">
                        
                        @error('sort')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('manage.slider.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Update slider</button>
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
@push('scripts')
    
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush