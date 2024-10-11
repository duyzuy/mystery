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
                <h3 class="card-title">Add brand</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('brands.store') }}">
                @csrf
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="viCityName">Brand name</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{ old('brand_name') }}" placeholder="Brand name">
                        
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
                  <button type="submit" class="btn btn-success">Create</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Brands list</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Brand name</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $key => $brand)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $brand->name }}</td>

                            <td><a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="deleteBrand({{ $brand->id }})"><i class="fas fa-trash"></i> Delete</a>
                                <form id="brand-{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id )}}" method="POST" style="display: none;">
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
                        <th>Brand name</th>
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
    
            $('#tableData').DataTable({
                "responsive": true,
            "autoWidth": false,
            });
        });


        function deleteBrand(Id) {
            Swal.fire({
            title: 'Delete Brand',
            text: "if Yes, all Resraurent are related this brand will be deleted",
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
                document.getElementById('brand-'+Id).submit()
                
              )
            }
          })
            
        }
 
 
        


    </script>
@endpush