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
              <li class="breadcrumb-item"><a href="{{ route('stores.index') }}">Store</a></li>
              <li class="breadcrumb-item active">Edit store</li>
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
                            <div class="col-12 col-sm-6">
                                
                                <label>City</label>
                                <select class="form-control @error('city') is-invalid @enderror" name="city">
                                    <option value="0">Select the city</option>
                                    @foreach($cities as $city)
                                        <option {{ $city->id == $store->city_id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->translate('en')->name }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select class="form-control @error('brand') is-invalid @enderror" name="brand">
                                        <option value="">Select brand</option>
                                        @foreach($brands as $brand)
                                            <option {{ $brand->id == $store->brand_id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                    
                                  </div>
                            </div>
                        </div>
                        <div class="form-group">
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" placeholder="Ex: http://example.com" value="{{ $store->store_website }}">
                                    @error('website')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('store_image') is-invalid @enderror">
                                    <label for="store_image">Store image</label>
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
                                    <div class="image-preview mt-2">
                                        @if($store->store_image == 'default.jpg')
                                        <img src="{{ asset('images') . '/' . $store->store_image }}" alt="store image" width="200"/>
                                        @else
                                        <img src="{{ asset('storage/stores') . '/' . $store->store_image }}" alt="store image" width="200"/>
        
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Restaurant code on bill</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" min="3" max="3" name="code" placeholder="etc: VHM" value="{{ $store->code }}">
                                    @error('code')
                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
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
                                            <input type="text" class="form-control @error('vi_store_name') is-invalid @enderror" name="vi_store_name" placeholder="Store name" value="{{ $store->translate('vi')->store_name }}"/>
                                            @error('vi_store_name')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="vi_store_address">Store Address</label>
                                            <input type="text" class="form-control @error('vi_store_address') is-invalid @enderror" name="vi_store_address" placeholder="Store Address" value="{{ $store->translate('vi')->store_address }}"/>
                                            @error('vi_store_address')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('vi_store_description') is-invalid @enderror">
                                            <label for="vi_store_description">Store descriptions</label>
                                            <textarea id="vi_summernote" class="textarea__summernote" name="vi_store_description">{{ $store->translate('vi')->store_description }}</textarea>
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
                                            <input type="text" class="form-control @error('en_store_name') is-invalid @enderror" name="en_store_name" placeholder="Store name" value="{{ $store->translate('en')->store_name }}"/>
                                            @error('en_store_name')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="en_store_address">Store Address</label>
                                            <input type="text" class="form-control @error('en_store_address') is-invalid @enderror" name="en_store_address" placeholder="Store Address" value="{{ $store->translate('en')->store_address }}"/>
                                            @error('en_store_address')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('en_store_description') is-invalid @enderror">
                                            <label for="en_store_description">Store descriptions</label>
                                            <textarea id="en_summernote" class="textarea__summernote" name="en_store_description">{{ $store->translate('en')->store_description }}</textarea>
                                        </div>
                                    </div>
                                    
                                  </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                        <a href="{{ route('stores.index') }}" class="btn btn-danger mr-2">Cancel</a>
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