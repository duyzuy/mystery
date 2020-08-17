@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/simplemde/simplemde.min.css') }}">

<style>
.note-editor{
    box-shadow: none !important;
}
    
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setting</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Section 1</h3>
                </div>
                <!-- /.card-header -->
           

                @php
                
                    $data_1_vi = json_decode($section1->translate('vi')->setting_value, true);
                    $data_1_en = json_decode($section1->translate('en')->setting_value, true);
                    $footer_en = json_decode($footer->translate('en')->setting_value, true);
                    $footer_vi = json_decode($footer->translate('vi')->setting_value, true);

                @endphp

                <!-- form start -->
                <form action="{{ route('manage.homepage.store') }}" method="POST">
                    @csrf
                  
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="section_1_title_vn">Title (VI)</label>
                                    <input type="text" class="form-control @error('section_1.vn.title') is-invalid @enderror" id="section_1_title_vn" name="section_1[vn][title]" value="{{ $data_1_vi['title'] }}">
                                     @error('section_1.vn.title')
                                         <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                     @enderror
                                 </div>
                                 <div class="form-group">
                                     <label for="vi_summernote">Content (VI)</label>
                                     <textarea id="vi_summernote" class="textarea__summernote @error('section_1.vn.content') is-invalid @enderror" name="section_1[vn][content]">{{ $data_1_vi['content'] }}</textarea>
                                    
                                     @error('section_1.vn.content')
                                          <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                     @enderror
                                  </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="section_1_title_en">Title (EN)</label>
                                    <input type="text" class="form-control @error('section_1.en.title') is-invalid @enderror" id="section_1_title_en" name="section_1[en][title]" value="{{ $data_1_en['title'] }}">
                                     @error('section_1.en.title')
                                         <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                     @enderror
                                 </div>
                                 <div class="form-group">
                                     <label for="en_summernote">Content (EN)</label>
                                     <textarea id="en_summernote" class="textarea__summernote @error('section_1.en.content') is-invalid @enderror" name="section_1[en][content]">{{ $data_1_en['content'] }}</textarea>
                                     @error('section_1.en.content')
                                          <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                     @enderror
                                  </div>
                            </div>
                        </div>
                        <!--/. End row 1 -->
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                 <div class="form-group">
                                     <label for="vi_summernote">Footer (VI)</label>
                                     <textarea id="vi_summernote" class="textarea__summernote @error('footer.vn.content') is-invalid @enderror" name="footer[vn][content]">{{ $footer_vi['content'] }}</textarea>
                                    
                                     @error('footer.vn.content')
                                          <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                     @enderror
                                  </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                 <div class="form-group">
                                     <label for="en_summernote_footer">Footer (EN)</label>
                                     <textarea id="en_summernote_footer" class="textarea__summernote @error('footer.en.content') is-invalid @enderror" name="footer[en][content]">{{ $footer_en['content'] }}</textarea>
                                     @error('footer.en.content')
                                          <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                     @enderror
                                  </div>
                            </div>
                        </div>

                        <hr/>
                     
                        </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
             
              </div>

        </div>
    </section>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/simplemde/simplemde.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>
        $('.textarea__summernote').summernote({
            height: 200,
            focus: true,
         
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
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
            },
           
        })
       

        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush