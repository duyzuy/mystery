@extends('layouts.app')

@push('styles')




@endpush
@section('content')<div class="content-wrapper" style="min-height: 1464.82px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reset Password</h1>
          </div>
          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reset Password</li>
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
                    
                        <form id="resetPasswordForm" action="{{ route('manage.user.resetpassword', $user->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group row">
                                <label for="userEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10 col-md-6 col-lg-4">
                                  <input type="text" readonly class="form-control-plaintext" name="user_email" id="userEmail" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="userPassword" class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10 col-md-6 col-lg-4">
                                    <input type="password" name="user_password" value="{{ old('user_password') }}" class="form-control @error('user_password') is-invalid @enderror"" id="userPassword">
                                    @error('user_password')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="userPasswordConfirm" class="col-sm-2 col-form-label">Confirm new password</label>
                                <div class="col-sm-10 col-md-6 col-lg-4">
                                  <input type="password" name="user_password_confirm" value="{{ old('user_password_confirm') }}" class="form-control @error('user_password_confirm') is-invalid @enderror"" id="userPasswordConfirm">
                                    @error('user_password_confirm')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="userAutoPassword" class="col-sm-2 col-form-label">Auto generate password</label>
                                <div class="col-sm-10 col-md-6 col-lg-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="auto_password" class="form-check-input" id="userAutoPassword">
                                    </div>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 col-md-6 col-lg-4">
                                    <button type="submit" class="btn btn-primary">Reset</button>
                                </div>
                            </div>
                                  
                            
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

<script type="text/javascript">
   
    $(function () {
      
        var form = $('#resetPasswordForm');
      
        var autoPassword = form.find('input[name="auto_password"]');
        var inputPassword = form.find('input[name="user_password"]');
        var passwordConfirm = form.find('input[name="user_password_confirm"]');
       

        autoPassword.on('change', function(){
            if(autoPassword.is(':checked')){
                inputPassword.val('');
                passwordConfirm.val('');
                passwordConfirm.removeClass('is-invalid');
                inputPassword.removeClass('is-invalid')
                inputPassword.attr('disabled', 'disabled');
                passwordConfirm.attr('disabled', 'disabled');
            }else{
                inputPassword.removeAttr('disabled');
                passwordConfirm.removeAttr('disabled');
            }
           
            
        })

    })
    
                         
</script>
@endpush





 

