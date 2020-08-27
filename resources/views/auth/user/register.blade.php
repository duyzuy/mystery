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
                                                        <input id="name" type="text" placeholder="@lang('user.pageRegister.label.name')" class="input @error('name') is-danger @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                                        <input id="email" type="email" placeholder="@lang('user.pageRegister.label.email')" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                                        <input id="phone_number" type="text" class="input @error('phone_number') is-danger @enderror" name="phone_number" value="{{ old('phone_number') }}" required placeholder="@lang('user.pageRegister.label.phone')" autocomplete="phone_number">
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
                                                        <input id="address" type="text" class="input @error('address') is-danger @enderror" name="address" value="{{ old('address') }}" placeholder="@lang('user.pageRegister.label.address')" required autocomplete="address">
                                                        <span class="icon is-small is-left"><i class="fas fa-map-marker"></i></span>
                                                    </div>
                                                    @error('address')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                 
                                        <div class="field">
                                            <hr class="navbar-divider mt-5 mb-5">
                                            <label class="is-size-5 label is-uppercase has-text-primary">@lang('user.pageRegister.label.location')</label>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="name">@lang('user.pageRegister.label.cityName')</label>
                                                    <div class="control has-icons-left is-fullwidth">
                                                        <div class="select is-fullwidth">
                                                            <select name="city" id="city" v-model="mCity" @change="getRestaurent()" class="form-control @error('city') is-invalid @enderror">
                                                                <option value>@lang('user.pageRegister.input.city')</option>
                                                            
                                                                
                                                                <option v-for="(city, index) in cities" :index="index" :value="city.id">@{{ city.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="icon is-small is-left">
                                                            <i class="fas fa-building"></i>
                                                        </div>
                                                    </div>
                                                    @error('city')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="name">@lang('user.pageRegister.label.brandName')</label>
                                                    <div class="control has-icons-left is-fullwidth">
                                                        <div class="select is-fullwidth">
                                                            <select name="brand" id="brand" v-model="mBrand"  @change="getRestaurent()" class="form-control @error('brand') is-invalid @enderror">
                                                                <option value>@lang('user.pageRegister.input.brand')</option>
                                                             
                                                                <option v-for="(brand, index) in brands" :index="index" :value="brand.id">@{{ brand.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="icon is-small is-left">
                                                            <i class="fas fa-leaf"></i>
                                                        </div>
                                                    </div>
                                                    @error('brand')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="field mb-5">
                                            <label for="store" class="label">@lang('user.pageRegister.label.restaurent')</label>
                                            <div class="control has-icons-left is-fullwidth">
                                                <div class="select is-fullwidth " :class="{ 'is-loading': isLoading}">
                                                    <select name="store" id="store" class="form-control @error('store') is-invalid @enderror" name="store">
                                                        <option value>@lang('user.pageRegister.input.restaurent')</option>
                                                        <option v-for="(restaurent, index) in restaurents" :index="index" :value="restaurent.id">@{{ restaurent.name }}</option>
                                                    </select>
                                                </div>
                                                <div class="icon is-small is-left">
                                                    <i class="fas fa-utensils"></i>
                                                </div>
                                            </div>

                                            @error('store')
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
               const app = new Vue({
                el: '#app',
                data: {
                    cities: [],
                    brands: [],
                    restaurents: [],
                    mCity: '',
                    mBrand: '',
                    lang: '{{ app()->getLocale() }}',
                    isLoading: false
                },
                watch: {
                    isLoading: _.debounce(function(){
                        this.isLoading = false;
                    }, 500)
                },
                mounted () {
                    
                    this.getCategory();
                    this.getBrand();
                    // this.getRestaurent();
                },
                methods: {
                    getCategory: function(){
                        const vm = this;
                        axios.get('../../api/cityList', {
                            params: {
                                lang: this.lang,
                            }
                        }).then(function(response){
                            vm.cities = response.data;
                        }).catch(function(error){
                                console.log(error)
                        });
                    },
                    getBrand: function(){
                        const vm = this;
                        axios.get('../../api/brandList', {
                            params: {
                                lang: this.lang,
                            }
                        }).then(function(response){   
                            vm.brands = response.data;

                        }).catch(function(error){
                                console.log(error)
                        });
                    },
                    getRestaurent: function(){
                        const vm = this;
                        this.isLoading = true;
                        axios.get('../../api/restaurentList', {
                            params: {
                                lang: this.lang,
                                city: this.mCity,
                                brand: this.mBrand,
                            }
                        }).then(function(response){
                      
                            vm.restaurents = response.data;
                            
                        }).catch(function(error){
                                console.log(error)
                        });
                    },
                  
                }
            })
    </script>
@endpush