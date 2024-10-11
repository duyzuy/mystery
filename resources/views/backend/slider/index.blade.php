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
              <form method="POST" action="{{ route('manage.slider.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Slider name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" placeholder="Slider name">
                        
                        @error('name')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('image') is-invalid @enderror">
                        <label for="image">Store image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose image</label>
                            </div>
                        </div>
                        @error('image')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sort">Sort</label>
                        <input type="number" name="sort" class="form-control @error('sort') is-invalid @enderror" value="{{ old('sort') }}" id="sort" placeholder="Sort">
                        
                        @error('sort')
                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Add slider</button>
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
                  <h3 class="card-title">Slider list</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="citiesdata" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width: 40px">ID</th>
                      <th style="width: 150px">Thumbnail</th>
                      <th>Link</th>
                      <th style="width: 40px">Sort</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $key => $slider)
                       <tr>
                            <td>{{ $key + 1 }}</td>
                            
                                @if($slider->slug != 'default.jpg')
                                    <td>
                                        <img src="{{ asset('storage/slider/' . $slider->slug) }}" style="width: 100px; height: 100px; object-fit: cover" alt="{{ $slider->name }}"/>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span>{{ asset('storage/slider/' . $slider->slug) }}</span>
                                    </td>
                                @else
                                    <td>
                                        <img src="{{ asset('images/default.jpg') }}" style="width: 100px; height: 100px; object-fit: cover" alt="{{ $slider->name }}"/>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span>No image</span>
                                    </td>
                                @endif
                                    <td style="vertical-align: middle;">{{ $slider->sort }}</td>
                           
                            <td style="vertical-align: middle;">
                                <a href="{{ route('manage.slider.edit', $slider->id) }}" class="btn btn-primary mr-2">Edit</a>
                                <a href="#" class="btn btn-danger" onclick="deleteData({{ $slider->id }})">Delete</a>
                                <form id="slider-{{ $slider->id }}" action="{{ route('manage.slider.delete', $slider->id) }}" method="POST" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                       </tr>
                       @endforeach
                    </tbody>
                    
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
    
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('js/backend/demo.js') }}"></script>
    <script>
       
        // $(function () {
    
        //     $('#citiesdata').DataTable({
        //         "responsive": true,
        //     "autoWidth": false,
        //     });
        // });


        function deleteData(Id) {
     
            document.getElementById('slider-'+Id).submit();
        }

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush