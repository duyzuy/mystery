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
            <h1>Create new store</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">Store</a></li>
              <li class="breadcrumb-item active">Store create</li>
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
                  <h3 class="card-title">Add new store</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('stores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" placeholder="Ex: http://example.com" value="{{ old('website') }}">
                                    @error('website')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-control @error('city') is-invalid @enderror" name="city">
                                        <option value="">Select the city</option>
                                        @foreach($cities as $city)
                                            <option {{ old('city') == $city->id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->translate('en')->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                  </div>
                            </div>
                        </div>
                        <div class="form-group @error('store_image') is-invalid @enderror">
                            <label for="store_image">Store image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="store_image" name="store_image">
                                    <label class="custom-file-label" for="store_image">Choose image</label>
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
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                      <h3 class="card-title">Vietnamese</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="vi_store_name">Store name</label>
                                            <input type="text" class="form-control @error('vi_store_name') is-invalid @enderror"" name="vi_store_name" placeholder="Store name" value="{{ old('vi_store_name') }}"/>
                                            @error('vi_store_name')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="vi_store_address">Store Address</label>
                                            <input type="text" class="form-control @error('vi_store_name') is-invalid @enderror"" name="vi_store_address" placeholder="Store Address" value="{{ old('vi_store_address') }}"/>
                                            @error('vi_store_address')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('vi_store_description') is-invalid @enderror">
                                            <label for="vi_store_description">Store descriptions</label>
                                            <textarea id="vi_summernote" class="textarea__summernote" name="vi_store_description">{{ old('vi_store_description') }}</textarea>
                                        </div>
                                    </div>
                                    
                                  </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                      <h3 class="card-title">English</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="en_store_name">Store name</label>
                                            <input type="text" class="form-control @error('en_store_name') is-invalid @enderror" name="en_store_name" placeholder="Store name" value="{{ old('en_store_name') }}"/>
                                            @error('en_store_name')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="en_store_address">Store Address</label>
                                            <input type="text" class="form-control @error('en_store_address') is-invalid @enderror" name="en_store_address" placeholder="Store Address" value="{{ old('en_store_address') }}"/>
                                            @error('en_store_address')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('en_store_description') is-invalid @enderror">
                                            <label for="en_store_description">Store descriptions</label>
                                            <textarea id="en_summernote" class="textarea__summernote" name="en_store_description">{{ old('en_store_description') }}</textarea>
                                        </div>
                                    </div>
                                    
                                  </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Create store</button>
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