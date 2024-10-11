@extends('layouts.app')



@push('styles')
<link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<style>

  .btn.active{
    color: #17a2b8
  }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">users</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                {{-- <a class="btn btn-primary" href="{{ route('stores.create') }}">Add new Store</a> --}}
            </div>
        
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-6">
              <a href="{{ route('manage.user.list') }}" class="btn {{ Request::is('manage/users') ? 'active' : '' }}"> All </a>
              {{-- <a href="{{ route('manage.user.filter', 'actived') }}" class="btn {{ Request::is('manage/user&status=actived') ? 'active' : '' }}"> User actived </a> --}}
              {{-- <a href="{{ route('manage.user.filter', 'unactive') }}" class="btn {{ Request::is('manage/user&status=unactive') ? 'active' : '' }}"> User un-active </a> --}}
            </div>
            <div class="col-6">
            
              @if(Request::is('manage/user&status=actived'))

                <a href="{{ route('manage.user.export', 'actived') }}" class="btn btn-primary btn-sm float-right">Export</a>

              {{-- @elseif(Request::is('manage/user&status=unactive'))

                <a href="{{ route('manage.user.export', 'unactive') }}" class="btn btn-primary btn-sm float-right">Export</a>

              @else --}}

                <a href="{{ route('manage.user.export', 'all') }}" class="btn btn-primary btn-sm float-right">Export</a>
                
              @endif
              
              <div class="form-group" style="display: none">
                <label>Date range:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="reservation" name="date_range">
                </div>
                <!-- /.input group -->
              </div>
            </div>
          </div>
        
        </div>
        <div class="card-body">
          <table class="table projects table table-bordered" id="tableData" data-page-length='25'>
              <thead>
                    <tr>
                        <th style="width: 5%">
                            #ID
                        </th>
                        <th style="width: 15%">
                            User name
                        </th>
                        <th style="width: 15%">Email</th>
                        <th style="width: 15%">Phone number</th>
                    
                        {{-- <th style="width: 10%">
                           Status
                        </th> --}}
                        <th style="width: 15%">Actions</th>
                        <th style="width: 15%">Register at</th>
                        <th class="d-none"></th>
                    </tr>
              </thead>
              <tbody>
                 
                  @foreach($users as $key => $user)
                    <tr>
                        <td>#{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        {{-- <td>{!! $user->actived == 0 ? '<span class="badge badge-danger">Unactive</span>' :  '<span class="badge badge-success">Actived</span>' !!}</td> --}}
                        <td>
                            <a class="btn btn-outline-primary btn-sm mr-2" target="_blank" href="{{ route('manage.user.show', $user->id) }}">View</a>
                            <a class="btn btn-outline-info btn-sm" href="{{ route('manage.export.userprofile', $user->id) }}">Export</a>
                            {{-- <a class="btn btn-info btn-sm" href="{{ route('manage.user.edit', $user->id) }}"><i class="fas fa-paper-plane mr-1"></i>New password</a> --}}
                        </td>
                        <td>{{ date('M j, Y', strtotime($user->created_at)) }}</td>
                        <td class="d-none">{{ $user->id }}</td>
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

<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
{{-- <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script> --}}
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- <script src="{{ asset('js/backend/demo.js') }}"></script> --}}
<script>
   
    $(function () {
      
   

    //Date range picker
 
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
  
    //Date range as a button
   
        $('#tableData').DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [[ 6, "desc" ]]
        });
    });

</script>
@endpush