@extends('frontend.master')
@section('title', 'Register')
@section('content')
    <section class="section section__register">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="columns">
                        <div class="column is-three-fifths is-offset-one-fifth">
                            <h1 class="title has-text-white">
                                MYSTERY DINNER
                            </h1>
                            <p class="subtitle has-text-white">
                                The Pepperonis Brand was created to offer similar comfort food, to that of Al Fresco’s, however, targets a more youthful, local and cost sensitive crowd.
Papa Joe’s Coffee was established to satisfy a niche in the market for tasty snacks, cakes and great coffee.
                            </p>
                        </div>
                    </div>
               
                </div>
            </div>
            <div class="container p-r-15 p-l-15">
                <div class="columns">
                
                    <div class="column is-half is-offset-one-quarter">
                
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="is-size-4 title">@lang('user.pageRegister.pageLabel')</h1>
                                </div>

                                <div class="card-content">
                                    <form method="POST" action="{{ route('user.register.submit', app()->getLocale()) }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="columns">
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="name">@lang('user.pageRegister.label.name')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="name" type="text" class="input @error('name') is-danger @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                        <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    @error('name')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="email">@lang('user.pageRegister.label.email')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    @error('email')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="phone_number">@lang('user.pageRegister.label.phone')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="phone_number" type="text" class="input @error('phone_number') is-danger @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                                                        <span class="icon is-small is-left"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    @error('phone_number')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="address">@lang('user.pageRegister.label.address')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="address" type="text" class="input @error('address') is-danger @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                                        <span class="icon is-small is-left"><i class="fas fa-map-marker"></i></span>
                                                    </div>
                                                    @error('address')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div id="file-js-example" class="file has-name is-primary mb-5">
                                                    
                                            <label class="file-label">
                                                {{-- <input id="bill_image" type="file" multiple class="form-control-file @error('bill_image') is-invalid @enderror" name="bill_image[]" value="{{ old('bill_image') }}" required autocomplete="bill_image"> --}}
                                            <input class="file-input" id="bill_image" multiple type="file" name="bill_image[]" value="{{ old('bill_image') }}" required autocomplete="bill_image">
                                            <span class="file-cta">
                                                <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                    @lang('user.pageRegister.label.bill')
                                                </span>
                                            </span>
                                            <span class="file-name is-fullwidth">
                                                No file uploaded
                                            </span>
                                            </label>
                                            @error('bill_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="field mb-5">
                                            <label for="store" class="label">@lang('user.pageRegister.label.restaurent')</label>
                                            <div class="control has-icons-left is-fullwidth">
                                                <div class="select is-fullwidth">
                                                    <select name="store" id="store" class="form-control @error('store') is-invalid @enderror" name="store">
                                                        <option value>@lang('user.pageRegister.input.restaurent')</option>
                                                        @foreach($cities as $key => $city)
                                                            <optgroup label="{{ $city->translate('en')->name }}">
                                                                @foreach($city['stores'] as $store)
                                                                    <option value="{{ $store->id }}" {{ old('store') == $store->id ? 'selected' : '' }}>{{ $store->translate()->store_name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="icon is-small is-left">
                                                    <i class="fas fa-utensils"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <hr class="navbar-divider">
                                            <label class="is-size-5 label is-uppercase has-text-primary">@lang('user.pageRegister.label.bankInfo')</label>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="name">@lang('user.pageRegister.label.bankName')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="bank_name" type="text" class="input @error('bank_name') is-danger @enderror" name="bank_name" value="{{ old('bank_name') }}"  autocomplete="bank_name">
                                                        <span class="icon is-small is-left"><i class="fas fa-university"></i></span>
                                                    </div>
                                                    @error('bank_name')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="name">@lang('user.pageRegister.label.bankCard')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="card_number" type="text" class="input @error('card_number') is-invalid @enderror" name="card_number" value="{{ old('card_number') }}"  autocomplete="card_number">
                                                        <span class="icon is-small is-left"><i class="fas fa-money-check"></i></span>
                                                    </div>
                                                    @error('card_number')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="label" for="name">@lang('user.pageRegister.label.bankAddress')</label>
                                            <div class="control has-icons-left has-icons-right">
                                                <input id="bank_address" type="text" class="input @error('bank_address') is-danger @enderror" name="bank_address" value="{{ old('bank_address') }}"  autocomplete="bank_address">
                                                <span class="icon is-small is-left"><i class="fas fa-map-marker"></i></span>
                                            </div>
                                            @error('bank_address')
                                                <p class="help is-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <hr class="navbar-divider mt-5 mb-5">
                                        <div class="field">
                                            <div class="control">
                                                <button type="submit" class="button is-primary is-outlined is-fullwidth">
                                                    @lang('user.button.register')
                                                </button>
                                            </div>
                                            <p class="control mt-2 has-text-centered">
                                                <a href="{{ route('user.login', app()->getLocale()) }}" class="is-size-7 has-text-primary">@lang('user.button.haveAccount')</a>
                                            </p>
                                        </div>
                
                                    </form>
                                </div>
                            </div>
            
                    </div>
                </div>
            </div>
    </section>

@endsection
@push('scripts')
    <script>
            const fileInput = document.querySelector('#file-js-example input[type=file]');
            fileInput.onchange = () => {
                if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file-js-example .file-name');
                fileName.textContent = fileInput.files[0].name;
                }
            }
    </script>
@endpush