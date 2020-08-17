@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1>Stores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stores</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <a class="btn btn-primary" href="{{ route('stores.create') }}">Add new Store</a>
            </div>
        
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
 
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                    <tr>
                        <th style="width: 5%">
                            #
                        </th>
                        <th style="width: 30%">
                            Store name
                        </th>
                        <th style="width: 20%">City</th>
                    
                        <th style="width: 25%">
                            <span style="margin-right: 10px;">EN</span>
                            <span>VI</span>
                        </th>
                        <th style="width: 20%">Actions</th>
                    </tr>
              </thead>
              <tbody>
                  @php 
                    $i = 1;
                  @endphp
                  @foreach($stores as $store)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $store->translate('en')->store_name }}</td>
                        <td>{{ $store->city->translate('en')->name }}</td>
                        <td><i class="fas fa-check" style="margin-right: 10px; color: #4CAF50"></i>
                            <i class="fas fa-check" style="color: #4CAF50"></i></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('stores.edit', $store->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="deleteCity({{ $store->id }})"><i class="fas fa-trash"></i> Delete</a>
                            <form id="store-{{ $store->id }}" action="{{ route('stores.destroy', $store->id )}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                    </td>
                    </tr>
                    @php 
                        $i++;
                    @endphp
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
<script>
       
 

    function deleteCity(Id) {
 
        document.getElementById('store-'+Id).submit()
    }


</script>
@endpush