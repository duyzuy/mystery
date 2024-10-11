@extends('layouts.app')

@push('styles')
<link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <style>
    .answer__group{
      display: flex
    }
    .answer__group .answer{
      flex: 1;
      max-width: 370px;
      padding-right: 20px
    }
    .responses{
      flex: 1;
      max-width: 220px;
    }
   
    .table td, .table th{
      border-color: #f1f1f1;
    }
    .table thead th{
      border-bottom-width: 0;
    }
    .table tr.not_view{
      background: #fffce3;
    }
    .table tr.not_view > td:first-child{
      border-left: 2px solid red;
    }
    /* .table tr.viewed > td:first-child{
      border-left: 2px solid #04cd04;
    } */
    .inner_store{
        padding: 10px;
        border: 1px solid #f1f1f1;
        border-radius: 5px;
        font-size: 13px
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
            <h1>Invitement</h1>
            <p>Date: {{ $dateFrom . ' to ' . $dateTo }}</p>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">invitement</li>
            </ol>
          </div>
        </div>
        <div class="col-12 mb-2 mt-2">
     
            <form action="{{ route('manage.invitement.listFilter') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col col-md-6 col-lg-3">
                      
                    <div class="form-group">
                        <label>Restaurant</label>
                 
                        <div class="input-group">
                            <select name="store" id="typeanswer" class="form-control form-control-sm @error('store') is-invalid @enderror">
                                <option value="all">All restaurant</option>
                                @foreach($cities as $city)
                                  <optgroup label="{{ $city->translate()->name }}">
                                    @foreach($city->stores as $store)
                                      <option {{ $storeId == $store->id ? 'selected' : '' }} value="{{ $store->id }}">{{ $store->translate()->store_name }}</option>
                                    @endforeach
                                  </optgroup>
                                @endforeach
                            </select>
                            @error('store')
                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- /.input group -->
                    </div>
                  </div>
                    <div class="col col-md-6 col-lg-3">
                     
                        <div class="form-group">
                            <label>Status:</label>

                            <div class="input-group">
                                <select name="status" id="typeanswer" class="form-control form-control-sm @error('status') is-invalid @enderror">
                                    <option {{ $status == 'all' ? 'selected' : '' }} value="all">All</option>
                                    <option {{ $status == 'cancel' ? 'selected' : '' }} value="cancel">Cancel</option>
                                    <option {{ $status == 'waiting' ? 'selected' : '' }} value="waiting">Waiting</option>
                                    <option {{ $status == 'notyet' ? 'selected' : '' }} value="notyet">Not confirmed yet</option>
                                    <option {{ $status == 'accept' ? 'selected' : '' }} value="accept">Accept</option>
                                    <option {{ $status == 'completed' ? 'selected' : '' }} value="completed">Completed</option>
                                </select>
                                @error('status')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col col-md-6 col-lg-3">
                     
                        <div class="form-group">
                            <label>Date:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="date" class="form-control form-control-sm float-right @error('date') is-invalid @enderror" id="reservation">
                                @error('date')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- /.input group -->
                        </div>
              
                </div>
                    <div class="col d-flex align-items-end">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Filter</button>
                        </div>
                       
                    </div>
                </div>
            </form>
            
        </div>
        <div class="row mb-2">
            <!-- Default box -->
              <div class="col-12">
                <div class="card">
                  
                  <div class="card-body">
                    <table id="dataTable" class="table" data-page-length='25' style="font-size: 0.9rem">
                        <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 10%">Name</th>
                                    <th style="width: 25%">Reataurant</th>
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 15%">Date</th>
                                    <th>Action</th>
                                    
                                </tr>
                        </thead>
                        <tbody>
                          @if(count($invites) > 0)
                            @foreach($invites as $invite)
                                <tr>
                                    <td class="inviteId">{{ $invite->id }}</td>
                                    <td class="userName">{{ $invite->user->name }}</td>
                                    <td class="storeName">
                                        @if($invite->storeApproved) {{ $invite->storeApproved->store_name }} @endif
                                    </td>
                                    <td class="status">
                                        @if($invite->response_status =='cancel')
                                            <span class="badge badge-danger">Canceled</span>
                                        @elseif($invite->response_status =='accept')
                                            <span class="badge badge-success">Apcepted</span>
                                        @elseif($invite->response_status =='waiting' &&  $invite->confirmed == '1')
                                            <span class="badge badge-warning">Waiting</span> 
                                        @elseif($invite->response_status =='waiting' &&  $invite->confirmed != '1')
                                            <span class="badge badge-warning">Not confirmed yet</span> 
                                        @else
                                            <span class="badge badge-success">Completed</span> 
                                        @endif
                                    
                                    </td>
                                    <td class="date">
                                        {{ date('M j, Y', strtotime($invite->created_at)) }}
                                    
                                    </td>
                                    <td class="action">
                                      @if($invite->confirmed == 0)
                                          <a href="#" data-id="{{ $invite->id }}" data-toggle="modal" data-target="#invitementModal" class="btn btn-outline-primary btn-sm  mr-2">view</a>
                                      @endif
                                      <a class="btn btn-outline-info btn-sm" href="{{ route('manage.user.show', $invite->user->id) }}">User detail</a>
                                  </td>
                                </tr>

                            @endforeach
                          @else
                                <tr><td colspan="6" align="center">No restaurant found</td></tr>
                          @endif
                        </tbody>
                    </table>
                </div>
             
             
                <!-- /.card -->
              </div>

          </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <div class="modal fade" id="invitementModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <form id="formConfirm" action="">
                <div class="message"></div>
                <div class="store__wrap"><div class="row"></div></div>
                <div class="time__checkin"></div>

                <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  @php 
    $dateFrom = explode("-", $dateFrom);
    $dateTo = explode("-", $dateTo);
    $jsDateFrom = $dateFrom[2] . '/' . $dateFrom[1] . '/' .$dateFrom[0];
    $jsDateTo = $dateTo[2] . '/' . $dateTo[1] . '/' .$dateTo[0];

    
    @endphp

@endsection
@push('scripts')
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
   
    // $(function () {

    //     $('#dataTable').DataTable({
    //         "responsive": true,
    //       "autoWidth": false,
    //     });
    // });

     $('#reservation').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        maxDate: new Date(),
        startDate: '{{ $jsDateFrom }}',
        endDate: '{{ $jsDateTo }}'
    })
   

    $('#invitementModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var status = button.parent('td').parent('tr').find('span.badge');
        var storeName = button.parent('td').parent('tr').find('td.storeName');
        var modal = $(this);
        var form = modal.find('#formConfirm');
        $.get('http://localhost/mystery/api/invitement&inviteId='+id+'', function($data){
        
            modal.find('.modal-title').text($data['user'].name);
            var htmlStore = '';
            var htmlTime = '';
            var htmlUserId = '';
            for(var i = 0; i < $data['stores'].length; i++){
                htmlStore += '<div class="col-12 col-sm-6 col-lg-4"><div class="inner_store mb-3">';
                htmlStore += '<ul class="ml-4 mb-3 fa-ul text-muted">';
                    htmlStore += '<li class="mb-2"><span class="fa-li"><i class="fas fa-university"></i></span> Region: '+$data['stores'][i].region+'</li>';
                    htmlStore += '<li class="mb-2"><span class="fa-li"><i class="fas fa-building"></i></span> City: '+$data['stores'][i].city+'</li>';
                    htmlStore += '<li class="mb-2"><span class="fa-li"><i class="fas fa-leaf"></i></span> Brand: '+$data['stores'][i].brand+'</li>';
                    htmlStore += '<li class="mb-2"><span class="fa-li"><i class="fas fa-utensils"></i></span> Restaurant: '+$data['stores'][i].name+'</li>';
                    htmlStore += '</ul>';  
                    htmlStore += '<div class="form-check">';   
                    htmlStore += '<input class="form-check-input" type="radio" name="store_id" value="'+$data['stores'][i].id+'" id="store-'+id+'-'+$data['stores'][i].name+'">';
                    htmlStore += '<label class="form-check-label" for="store-'+id+'-'+$data['stores'][i].name+'">Chose</label>';
                    htmlStore += '<input type="hidden" value="'+id+'" name="registration_index">';                                   
                htmlStore += '</div></div></div>';
            }

            htmlTime += '<div class="form-group"><label>Chose date check-in</label>';
            htmlTime += '<div class="form-group">';       
            htmlTime += '<div class="input-group check_intime" id="storeTime" data-target-input="nearest">';         
            htmlTime += '<input type="text" class="form-control datetimepicker-input" name="check_in" data-target="#storeTime"/>';            
            htmlTime += '<div class="input-group-append" data-target="#storeTime" data-toggle="datetimepicker">';                
            htmlTime += '<div class="input-group-text"><i class="fa fa-calendar"></i></div>';                
            htmlTime += '</div></div></div></div>';                   
            htmlUserId += '<input type="hidden" name="user_id" value="'+$data['user'].id+'">';             
       
            modal.find('.time__checkin').html(htmlTime + htmlUserId);
            modal.find('.store__wrap .row').html(htmlStore);
            
            $('.check_intime').datetimepicker({
                sideBySide: true,
                defaultDate: new Date(),
                minDate: new Date(),
                format: 'dddd, MMMM Do YYYY, HH:mm',
                
            });
        })

        //submit form

        form.on('submit', function(e){
            e.preventDefault();
            var timeCheck = $(this).find('input[name="check_in"]').val();
            var storeCheck = $(this).find('input[name="store_id"]:checked');
            var message = $(this).find('.message');
            var userId = $(this).find('input[name="user_id"]').val();
            if(storeCheck.length == 0){
                message.html('<p class="error invalid-feedback d-block" role="alert">Please chose store</p>');
                return;
            }
            message.text('');
            var storeId = storeCheck.val();
            
           $.post('http://localhost/mystery/api/invitement', {inviteId: id, timeCheckin: timeCheck, storeId: storeId, userId: userId })
           .done(function(data){
              console.log(data);
              if(data.status == 'success'){
                $('#invitementModal').modal('hide');
                status.text('waiting');
                storeName.text(data.storeName);
                button.remove();
              }
           });
        })
        
        
    })
    

</script>
@endpush