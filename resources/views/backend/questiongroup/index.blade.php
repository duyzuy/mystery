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
            <h1>Groups</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('manage.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Question Group</li>
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
                <h3 class="card-title">Add new Group</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('manage.questiongroup.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="viGroupName">Group name (Vietnamese)</label>
                    <input type="text" name="vi_group_name" class="form-control @error('vi_group_name') is-invalid @enderror" id="viGroupName" placeholder="Group name (vietnamese)">
                    @error('vi_group_name')
                      <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="enGroupName">Group name (English)</label>
                    <input type="text" name="en_group_name" class="form-control @error('en_group_name') is-invalid @enderror" id="enGroupName" placeholder="Group name (English)">
                    @error('en_group_name')
                      <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Create new Group</button>
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
                  <h3 class="card-title">Group list</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="citiesdata" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Group Name (VI)</th>
                      <th>Group Name (EN)</th>
                      
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                     
                        @foreach($groups as $key => $group)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $group->translate('vi')->title }}</td>
                            <td>{{ $group->translate('en')->title }}</td>
                           
                            <td><a href="{{ route('manage.questiongroup.edit', $group->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="#" onclick="deleteGroup({{ $group->id }})"><i class="fas fa-trash"></i> Delete</a>
                                <form id="group-{{ $group->id }}" action="{{ route('manage.questiongroup.delete', $group->id )}}" method="POST" style="display: none;">
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
                        <th>Group Name (VI)</th>
                        <th>Group Name (EN)</th>
                        
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


        function deleteGroup(Id) {
     
            document.getElementById('group-'+Id).submit()
        }


    </script>
@endpush