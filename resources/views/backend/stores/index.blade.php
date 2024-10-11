@extends('layouts.app')
@push('styles')

<link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1>Restaurants</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Restaurants</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <a class="btn btn-primary" href="{{ route('stores.create') }}">Add new Restaurant</a>
            </div>
        
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Restaurant list</h3>
        </div>
        <div class="card-body">
          <table id="dataTable" class="table table-bordered table-striped">
              <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 5%">Code</th>
                        <th style="width: 35%">Restaurant name</th>
                        {{-- <th style="width: 10%">Region</th> --}}
                        <th style="width: 15%">City</th>
                        <th style="width: 20%">brand</th>
                        
                        <th style="width: 20%">Actions</th>
                    </tr>
              </thead>
              <tbody>
             
                  @foreach($stores as $key => $store)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td style="text-transform:uppercase">{{ $store->code }}</td>
                        <td>{{ $store->translate('en')->store_name }}</td>
                        {{-- <td>{{ $store->city->region->translate('en')->name }}</td> --}}
                        <td>{{ $store->city->translate('en')->name }}</td>
                        <td>{{ $store->brand->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('stores.edit', $store->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="deleteStore({{ $store->id }})"><i class="fas fa-trash"></i> Delete</a>
                            <form id="store-{{ $store->id }}" action="{{ route('stores.destroy', $store->id )}}" method="POST" style="display: none;">
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
      <!-- /.card -->

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
