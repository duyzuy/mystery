@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
<style>
.note-editor{
    box-shadow: none !important;
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
            <h1>Questionnairs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Questionnairs</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('manage.survey.update', [$user->id, $survey->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <h4 class="mb-3">User information</h4>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('User Name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Full name">
                                    </div>
                                    
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                        <label for="email">{{ __('User Email') }}</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="phone_number">{{ __('Phone number') }}</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" placeholder="Phone number">
                                    </div>
                                    
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                        <label for="address">{{ __('Address') }}</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="mb-3">Survey details</h4>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="staff_name">{{ __('Staff name') }}</label>
                                        <input type="text" class="form-control" id="staff_name" name="staff_name" value="{{ $survey->staff_name }}" placeholder="Staff name">
                                    </div>
                                    
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                        <label for="manager_name">{{ __('Manager Name') }}</label>
                                        <input type="text" class="form-control" id="manager_name" name="manager_name" value="{{ $survey->manager_name }}" placeholder="Manage Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="receipt_number">{{ __('Receipt number') }}</label>
                                        <input type="text" class="form-control" id="receipt_number" name="receipt_number" value="{{ $survey->receipt_number }}" placeholder="Staff name">
                                    </div>
                                    
                                    </div>
                                   
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('manage.questionnaire.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </form>
                    </div>
                </div>
                
                
            </div>
        
          </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
@endsection
@push('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>
        $('.textarea__summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ],
            hint: {
                words: ['apple', 'orange', 'watermelon', 'lemon'],
                match: /\b(\w{1,})$/,
                search: function (keyword, callback) {
                callback($.grep(this.words, function (item) {
                    return item.indexOf(keyword) === 0;
                }));
                }
            }
        })

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush