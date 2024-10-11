@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">


@endpush
@section('content')<div class="content-wrapper" style="min-height: 1464.82px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Detail</h1>
          </div>
          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <div class="col-12 d-flex align-items-stretch">
              <div class="card bg-light" style="width: 100%">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-6">
                        <h2 class="lead"><b>{{ $user->name }}</b> </h2>
                        {{-- <p class="text-muted"><b>Status: </b> {!! $user->actived == 0 ? '<span class="badge badge-danger">Unapprove</span>' :  '<span class="badge badge-success">Approved</span>' !!} </p> --}}
                      </div>
                      {{-- <div class="col-6">
                        <div class="text-right">
                          @if($user->actived == 0)
                            <a href="#" class="btn btn-sm btn-success" onclick="event.preventDefault();
                            document.getElementById('user-approval').submit();"><i class="fas fa-check mr-2"></i>Approve</a>
                            <form id="user-approval" action="{{ route('manage.user.approval', [$user->id, 'approve']) }}" method="POST">
                                @csrf
                            </form>
                          @else
                            <a href="" class="btn btn-sm btn-danger" onclick="event.preventDefault();
                            document.getElementById('user-approval').submit();"><i class="fas fa-check mr-2"></i> UnApprove</a>
                            <form id="user-approval" action="{{ route('manage.user.approval', [$user->id, 'unapprove']) }}" method="POST">
                              @csrf
                          </form>
                          @endif
                        </div>
                      </div> --}}
                      <div class="col-6">
                        <div class="text-right">
                          <a href="{{ route('manage.user.reinvite', $user->id) }}" class="btn btn-sm btn-success"><i class="fas fa-paper-plane mr-1"></i>Re-invite</a>
                          <a class="btn btn-info btn-sm" href="{{ route('manage.user.show.resetpassword', $user->id) }}" onclick="resetpassword({{ $user->id }})"><i class="fas fa-lock mr-1"></i>Reset password</a>
                         
                        </div>
                      </div>
                    </div>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-building"></i></span> Address: {{ $user->address }}</li>
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-envelope"></i></span> Email: {{ $user->email }}</li>
                        
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-phone"></i></span> Phone: {{ $user->phone_number }}</li>
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-birthday-cake"></i></span> Birthday: {{ $user->day_of_birth }}</li>
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-venus-mars"></i></span> Gender: {{ $user->gender }}</li>
                      </ul>
                      <hr>
                     
                      <h3 class="lead"><b>{{ __('Answer registration') }}</b></h3>
                      <ul class="ml-0 mb-0 fa-ul text-muted">
                       
                        @foreach($signUpRespponses as $key => $response)
                          <li><strong>{{ $key + 1 }}. </strong>{!! $response->question->translate($user->locale)->questions !!}</li>
                          <li>{!! $response->answer !!}</li>
                        @endforeach
                      </ul>
                   
                      <hr>
                      <h3 class="lead"><b>{{ __('Registered restaurants') }}</b></h3>
                      
                   
                      @foreach($storeRegistrations as $key => $storeRegistration)
                          <div class="store__registration  mb-5">
                            <div class="row header">
                              <div class="col col-6">
                                <div class="mb-3">Registration {{ $key + 1 }}</div>
                              </div>
                              <div class="col col-6">
                                <div class="text-right">
                                  @if($storeRegistration['response_status'] == 'cancel')
                          
                                    <p class="text-muted"><span class="badge badge-danger">Canceled</span> </p>
                                  @elseif( $storeRegistration['response_status'] == 'accept')
                                
                                    <p class="text-muted"><span class="badge badge-success">Accepted</span> </p>
                                  @elseif($storeRegistration['response_status'] == 'completed')
                              
                                    <p class="text-muted"><span class="badge badge-success">Completed</span> </p>

                                  @elseif($storeRegistration['response_status'] == 'waiting' && $storeRegistration['confirmed'] == 1)
                           
                                      <p class="text-muted"><b></b> <span class="badge badge-warning">Waiting</span> </p>

                                  @endif
                                </div>
                              </div>
                            </div>
                            
                         
                            @if($storeRegistration['confirmed'] == 1)
                              <div class="row">
                                @foreach($storeRegistration['stores'] as $store)
                                  <div class="col-12 col-sm-6 col-lg-4 {{ $storeRegistration['store_id'] == $store->id ? 'chosed' : 'not' }}">
                                    <div class="card">
                                      <div class="card-body">
                                        <ul class="ml-4 mb-3 fa-ul text-muted">
                                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-university"></i></span> Region: {{ $store->city->region->translate('en')->name }}</li>
                                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-building"></i></span> City: {{ $store->city->translate('en')->name }}</li>
                                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-leaf"></i></span> Brand: {{ $store->brand->name }}</li>
                                            <li  class="mb-2"><span class="fa-li"><i class="fas fa-utensils"></i></span> Restaurant: {{ $store->translate('en')->store_name }}</li>
                                        </ul> 
                                      </div>
                                      <div class="card-footer">
                                          @if( $storeRegistration['store_id'] == $store->id)
                                            <div class="row">
                                              <div class="col-6">
                                                <p class="mb-0 text-success"><i class="fas fa-check mr-2"></i>Chosed</p>
                                              </div>
                                              <div class="col-6 text-right">
                                                <p class="mb-0 text-success"><i class="fas fa-calendar-day mr-2"></i>
                                                  @php
                                                    $time = new TimeFormat( $storeRegistration['check_in'])  
                                                  @endphp
                                                  {{ $time->getTime() }}
                                                
                                                </p>
                                              </div>
                                            </div>
                                          @else
                                            <p class="mb-0 text-danger"><i class="fas fa-times mr-2"></i>No</p>
                                          @endif
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                              </div>
                             
                              @if($storeRegistration['response_status'] == 'waiting')
                                <div class="row">
                                  <div class="col-12">
                                    <a href="#" class="btn btn-danger" onclick="cancelInvite({{ $storeRegistration['index'] }})">Cancel</a>
                                    <form id="registerStore-{{ $storeRegistration['index'] }}" action="{{ route("manage.user.cancel.invite", [$user->id, $storeRegistration['index']]) }}" method="POST">
                                      @csrf
                                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                                      <input type="hidden" name="register_id" value="{{ $storeRegistration['index'] }}">
                                    </form>
                                  </div>
                                </div>
                              @endif
                            @else
                              <form action="{{ route('manage.user.approval.store', [$user->id, $storeRegistration['index']]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    @foreach($storeRegistration['stores'] as $store)
                                      <div class="col-12 col-sm-6 col-lg-4">
                                        <div class="card">
                                          <div class="card-body">
                                            <ul class="ml-4 mb-3 fa-ul text-muted">
                                                <li  class="mb-2"><span class="fa-li"><i class="fas fa-university"></i></span> Region: {{ $store->city->region->translate('en')->name }}</li>
                                                <li  class="mb-2"><span class="fa-li"><i class="fas fa-building"></i></span> City: {{ $store->city->translate('en')->name }}</li>
                                                <li  class="mb-2"><span class="fa-li"><i class="fas fa-leaf"></i></span> Brand: {{ $store->brand->name }}</li>
                                                <li  class="mb-2"><span class="fa-li"><i class="fas fa-utensils"></i></span> Restaurant: {{ $store->translate('en')->store_name }}</li>
                                            </ul> 
                                          </div>
                                          <div class="card-footer">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="store_id" value="{{ $store->id  }}" id="store-{{ $storeRegistration['index'] }}-{{ $store->id }}">
                                              <label class="form-check-label" for="store-{{ $storeRegistration['index'] }}-{{ $store->id }}">Chose</label>
                                              <input type="hidden" value="{{ $storeRegistration['index'] }}" name="registration_index">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                  <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                      <label>Chose date check-in</label>
                                        <div class="form-group">
                                          <div class="input-group check_intime" id="storeTime-{{ $storeRegistration['index'] }}" data-target-input="nearest">
                                              <input type="text" class="form-control datetimepicker-input" name="check_in" data-target="#storeTime-{{ $storeRegistration['index'] }}"/>
                                              <div class="input-group-append" data-target="#storeTime-{{ $storeRegistration['index'] }}" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                  
                                  </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Send Email confirm</button>
                              </form>

                            @endif
                        </div>
                      @endforeach

                          
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                      <div class="text-left">
                   
                        <a href="{{ route('manage.user.list') }}" class="btn btn-sm btn-info"><i class="fas fa-chevron-left mr-2"></i> Back</a>
  
                      </div>
                    </div>
                   
                  </div>
               
                  
                </div>
              </div>
            </div>
   
          </div>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection
@push('scripts')
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script type="text/javascript">
    // $(function () {
    //   $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    //     event.preventDefault();
    //     $(this).ekkoLightbox({
    //       alwaysShowClose: true
    //     });
    //   });

    // })
    function resetpassword(userId){
      document.getElementById('resetpassword-'+userId).submit();
    }

    function cancelInvite(registerId){
      document.getElementById('registerStore-'+registerId).submit();
    }
    
    $('.check_intime').datetimepicker({
          //inline: true,
          sideBySide: true,
          defaultDate: new Date(),
          minDate: new Date(),
          format: 'dddd, MMMM Do YYYY, HH:mm',
         
    });
    
                         
</script>
@endpush





 

