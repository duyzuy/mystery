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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit store</h1>
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
                  <h3 class="card-title">Edit store</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                           
                        </div>
                        <div class="form-group">
                           
                        </div>
                        <div class="form-group @error('store_image') is-invalid @enderror">
                            <label for="store_image">Store image</label>
                            <div class="image-preview mb-2">
                                <img src="{{ asset('public/storage/stores') . '/' . $store->store_image }}" alt="store image" width="200"/>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="hidden" id="store_old_image" name="store_old_image" value="{{ $store->store_image }}">
                                    <input type="file" class="custom-file-input" id="store_image" name="store_image">
                                    <label class="custom-file-label" for="store_image">Change image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('store_image')
                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                       
                      
                        <hr/>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                      <h3 class="card-title">English</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                       
                                    </div>
                                    
                                  </div>
                            </div>
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
    <!-- /.content -->
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