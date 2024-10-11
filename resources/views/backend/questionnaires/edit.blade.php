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
                        <form method="POST" action="{{ route('manage.questionnaire.update', $questionnaire->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12 col-lg-6 mb-5">
                                  <div class="form-group">
                                    <label for="vi_title">{{ __('Title (VI)') }}</label>
                                    <input type="text" class="form-control" id="vi_title" name="vi_title" value="{{ $questionnaire->translate('vi')->title }}" placeholder="Questionnaire title">
                                  </div>
                                  <div class="form-group">
                                    <label for="vi_title">{{ __('Description (VI)' ) }}</label>
                                    <textarea class="textarea__summernote" id="vi_description" name="vi_description">{{ $questionnaire->translate('vi')->description }}</textarea>
                                  </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                  <div class="form-group">
                                    <label for="title">{{ __('Title (EN)') }}</label>
                                    <input type="text" class="form-control" id="en_title" name="en_title" value="{{ $questionnaire->translate('en')->title }}" placeholder="Questionnaire title">
                                  </div>
                                  <div class="form-group">
                                    <label for="vi_title">{{ __('Description (EN)') }}</label>
                                    <textarea class="textarea__summernote" id="en_description" name="en_description">{{ $questionnaire->translate('en')->description }}</textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="{{ route('manage.questionnaire.index') }}" class="btn btn-danger">Cancel</a>
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