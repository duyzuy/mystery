@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
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
           
                      <h2 class="lead"><b>{{ $user->name }}</b> </h2>
                      <p class="text-muted"><b>Status: </b> {!! $user->actived == 0 ? '<span class="badge badge-danger">Unapprove</span>' :  '<span class="badge badge-success">Approved</span>' !!} </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-building"></i></span> Address: {{ $user->address }}</li>
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-envelope"></i></span> Email: {{ $user->email }}</li>
                        
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-phone"></i></span> Phone #: {{ $user->phone_number }}</li>
                      </ul>
                      <hr>

                      <h3 class="lead"><b>{{ __('Bank information') }}</b></h3>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-university"></i></span> Bank name: {{ $user->bank_name }}</li>
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-money-check"></i></span> Card number: {{ $user->bank_number }}</li>
                        
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-map-marker"></i></span> Bank address: {{ $user->bank_address }}</li>
                      </ul>
                      <hr>
                      
                      <h3 class="lead"><b>{{ __('Bill information') }}</b></h3>
                     
                      <ul class="ml-4 mb-3 fa-ul text-muted">
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-store"></i></span> Store name: {{ $user->store->translate('en')->store_name }}</li>
                        <li  class="mb-2"><span class="fa-li"><i class="fas fa-map-marker"></i></span> Store address: {{ $user->store->translate('en')->store_address }}</li>
                      </ul>
                      <h3 class="lead"><b>{{ __('Bill images') }}</b></h3>

                            <div class="row">
                                @if(count($user->images) != 0)
                                    @foreach($user->images as $key => $image)
                                        @php
                                            $url = json_decode($image->url, true)
                                        @endphp
                                        
                                        <div class="col-sm-2">
                                            <a href="{{ asset('storage/bill') . '/'. $url['original'] }}" data-toggle="lightbox" data-title="{{ $image->name }}" data-gallery="gallery">
                                              <img src="{{ asset('storage/bill') .'/'. $url['thumbnail'] }}" class="img-fluid mb-2" alt="white sample"/>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                        <p class="alert">{{ __('No image') }}</p>
                                @endif
                            </div>
                          
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                      <div class="text-left">
                   
                        <a href="{{ route('manage.user.list') }}" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left  mr-2"></i> Back</a>
  
                    </div>
                    </div>
                    <div class="col-6">
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
<script>
    $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

  })

</script>
@endpush