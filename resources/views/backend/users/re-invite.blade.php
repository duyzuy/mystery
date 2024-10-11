@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">



@endpush
@section('content')<div class="content-wrapper" style="min-height: 1464.82px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Re-invite user</h1>
          </div>
          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Re-invite user</li>
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
                      <div class="col-12">
                        <h2 class="lead"><b>{{ $user->name }}</b> </h2>
                        <hr>
                      </div>
               
                      <div class="col-12">
                    
                        <form action="{{ route('manage.user.sendinvite', $user->id) }}" method="POST">
                            @csrf
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                  <label>Select restaurants</label>
                                  {{-- <select class="select2 @error('stores') is-invalid @enderror" multiple="multiple" name="stores[]" data-placeholder="Select a State" style="width: 100%;">
                                    @foreach($cities as $key => $city)
                                    <optgroup label="{{ $city->translate()->name }}"> 
                                        @foreach($city->stores as $store)
                                      
                                          <option value="{{ $store->id }}">{{ $store->translate()->store_name }}</option>
    
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                  </select>
                                  @error('stores')
                                      <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                  @enderror --}}
                                  <select name="store" id="store" class="form-control @error('store') is-invalid @enderror">
                                    @foreach($cities as $key => $city)
                                      <option value="">Select restaurant</option>
                                    <optgroup label="{{ $city->translate()->name }}"> 
                                        @foreach($city->stores as $store)
                                      
                                          <option value="{{ $store->id }}">{{ $store->translate()->store_name }}</option>
    
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                  </select>
                                  @error('store')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                  <label>Chose date check-in</label>
                                    <div class="form-group">
                                      <div class="input-group check_intime" id="storeTime" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input @error('check_in') is-invalid @enderror"" name="check_in" data-target="#storeTime"/>
                                          @error('check_in')
                                              <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                          @enderror
                                          <div class="input-group-append" data-target="#storeTime" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            
                          
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-primary">Send invite</button>
                        </form>
                        <div class="card card-default">
                          
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
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
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
    $('.select2').select2();
    $('.duallistbox').bootstrapDualListbox();

    $('.check_intime').datetimepicker({
          //inline: true,
          sideBySide: true,
          defaultDate: new Date(),
          minDate: new Date(),
          format: 'dddd, MMMM Do YYYY, HH:mm',
         
    });
    
                         
</script>
@endpush





 

