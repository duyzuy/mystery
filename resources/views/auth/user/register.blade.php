@extends('frontend.master')
@section('title', 'Register')
@push('styles')
 
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
@section('content')
    <section class="section section__register">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-three-fifths is-offset-one-fifth">
                            @if(app()->getlocale() == 'en')
                                <h1 class="title has-text-white has-text-centered m-b-40"> MYSTERY DINER </h1>
                                <div class="descriptions has-text-justified">
                                    <ul class="has-text-white " style="list-style-type: disc; padding-left: 30px">
                                        <li class="m-b-10">AFG Vietnam strives to offer all our customers and guests a relaxed and friendly environment with professional service and great value for money, quality food</li>
                                        <li class="m-b-10">The Mystery Diner helps us learn if we are meeting the expectations of our loyal customers and guests and giving them the WOW factor.</li>
                                        <li>We value your contribution and support of our high standards by reviewing us and look forward to having you continue to be a loyal and supportive friend of the Al Fresco’s Group (AFG Vietnam)</li>
                                    </ul>
                                </div>
                            @else
                                <h1 class="title has-text-white has-text-centered m-b-40"> CHƯƠNG TRÌNH KHÁCH HÀNG THÁM TỬ </h1>
                                <div class="descriptions has-text-justified">
                                    <ul class="has-text-white" style="list-style-type: disc; padding-left: 30px">
                                        <li class="m-b-10">AFG Việt Nam luôn nỗ lực mang đến cho khách hàng không gian dùng bữa thoải mái, thân thiện cùng với đội ngũ phục vụ chuyên nghiệp, chất lượng món ăn ngon và tương xứng với mức giá hợp lý. </li>
                                        <li class="m-b-10">Chương trình Khách hàng thám tử sẽ giúp chúng tôi hiểu thêm xem liệu chúng tôi có đáp ứng được kỳ vọng của các khách hàng yêu quý và có mang đến trãi nghiệm WOW đầy ấn tượng cho họ không?</li>
                                        <li>Chúng tôi đánh giá cao sự đóng góp và hỗ trợ của các bạn Khách hàng thám tử trong việc đáp ứng các tiêu chuẩn cao của chúng tôi khi tham gia chương trình, giúp chúng tôi đánh giá toàn diện dịch vụ nhà hàng và chúng tôi mong muốn các bạn sẽ tiếp tục là người bạn đồng hành và ủng hộ Al Fresco’s Group (AFG Việt Nam).</li>
                                    </ul>
                                </div>
                            @endif
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
                                                        <input id="name" type="text" placeholder="@lang('user.pageRegister.label.name')" class="input @error('name') is-danger @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                                        <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    @error('name')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end--fullname--->
                                            <div class="column">
                                                <b-field label="@lang('user.pageRegister.label.dateBirth')" @error('date_of_birth') type="is-danger" @enderror>
                                                    <b-datepicker
                                                        v-model="dateBirth"
                                                        icon="fas fa-calendar-day"
                                                        :show-week-number="showWeekNumber"
                                                        :locale="locale"
                                                        placeholder="@lang('user.pageRegister.label.dateBirth')"
                                                        icon="calendar-today"
                                                        trap-focus
                                                        name="date_of_birth"
                                                        >
                                                    </b-datepicker>
                                                </b-field>
                                                    @error('date_of_birth')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                            </div>
                                            <!--date--of--birth--->
                                            <input type="hidden" name="raw_date_birth" :value="dateBirth">

                                            
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="phone_number">@lang('user.pageRegister.label.phone')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="phone_number" type="text" class="input @error('phone_number') is-danger @enderror" name="phone_number" value="{{ old('phone_number') }}" placeholder="@lang('user.pageRegister.label.phone')" autocomplete="phone_number">
                                                        <span class="icon is-small is-left"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    @error('phone_number')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!---phone---->
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="gender">@lang('user.pageRegister.label.gender')</label>
                                                    
                                                    <div class="control has-icons-left">
                                                        <div class="select is-fullwidth">
                                                          <select name="gender" id="gender" class="input @error('gender') is-danger @enderror">
                                                            <option value="" selected >@lang('user.pageRegister.input.gender.all')</option>
                                                            <option value="male" {{ old('gender') === 'male' ? 'selected': '' }}>@lang('user.pageRegister.input.gender.male')</option>
                                                            <option value="female" {{ old('gender') === 'female' ? 'selected': '' }}>@lang('user.pageRegister.input.gender.female')</option>
                                                            <option value="other" {{ old('gender') === 'other' ? 'selected': '' }}>@lang('user.pageRegister.input.gender.other')</option>
                                                          </select>
                                                        </div>
                                                        <div class="icon is-small is-left"><i class="fas fa-venus-mars"></i></div>
                                                      </div>
                                                    @error('gender')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!---end----gender---->
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="address">@lang('user.pageRegister.label.address')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="address" type="text" class="input @error('address') is-danger @enderror" name="address" value="{{ old('address') }}" placeholder="@lang('user.pageRegister.label.address')" autocomplete="address">
                                                        <span class="icon is-small is-left"><i class="fas fa-map-marker"></i></span>
                                                    </div>
                                                    @error('address')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!---address--->
                                            <div class="column">
                                                <div class="field">
                                                    <label class="label" for="email">@lang('user.pageRegister.label.email')</label>
                                                    <div class="control has-icons-left has-icons-right">
                                                        <input id="email" type="email" placeholder="@lang('user.pageRegister.label.email')" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    @error('email')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-----email---->
                                        </div>
                                        
                                        <div class="field">
                                            <hr class="navbar-divider mt-5 mb-5">
                                            <label class="is-size-5 label is-uppercase has-text-primary">@lang('user.pageRegister.label.answerq')</label>
                                        </div>
                                      

                                        @foreach($questions as $key => $question)
                                            @php $i = $key + 1 @endphp
                                            <div class="field">
                                                <label for="aq-{{ $i }}" class="m-b-10 is-block is-bold">{{ $i }}. {{ $question->translate()->questions }}</label>
                                                <div class="control">

                                                    
                                                    @if($question->id == 1)
                                                    <div class="columns is-multiline @error('responses. ' . $key . '.answer') is-danger @enderror">
                                                        <div class="column is-one-third pb-0">
                                                            <div class="field">
                                                                <b-radio v-model="radio.questionone" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.1.1')" type="is-danger"> @lang('user.pageRegister.answer.1.1') </b-radio>
                                                            </div>
                                                        </div>
                                                        <div class="column is-one-third pb-0">
                                                            <div class="field">
                                                                <b-radio v-model="radio.questionone" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.1.2')" type="is-danger"> @lang('user.pageRegister.answer.1.2') </b-radio>
                                                            </div>
                                                        </div>    
                                                        <div class="column is-one-third pb-0">
                                                            <div class="field">
                                                                <b-radio v-model="radio.questionone" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.1.3')" type="is-danger"> @lang('user.pageRegister.answer.1.3') </b-radio>
                                                            </div>
                                                        </div>   
                                                        <div class="column is-one-third pb-0">
                                                            <div class="field">
                                                                <b-radio v-model="radio.questionone" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.1.4')" type="is-danger"> @lang('user.pageRegister.answer.1.4') </b-radio>
                                                            </div>
                                                        </div>   
                                                        <div class="column is-one-third pb-0">
                                                            <div class="field">
                                                                <b-radio v-model="radio.questionone" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.1.5')" type="is-danger"> @lang('user.pageRegister.answer.1.5') </b-radio>
                                                            </div>
                                                            
                                                        </div>
                                                            
                                                           
                                                    </div>
                                                        
                                                    @elseif($question->id == 2)
                                                        <div class="columns is-multiline @error('responses. ' . $key . '.answer') is-danger @enderror">
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-radio v-model="radio.questiontwo" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.2.1')" type="is-danger"> @lang('user.pageRegister.answer.2.1') </b-radio>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-radio v-model="radio.questiontwo" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.2.2')" type="is-danger"> @lang('user.pageRegister.answer.2.2') </b-radio>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-radio v-model="radio.questiontwo" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.2.3')" type="is-danger"> @lang('user.pageRegister.answer.2.3') </b-radio>
                                                                </div>
                                                            </div>   
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-radio v-model="radio.questiontwo" name="responses[{{ $key }}][answer]" native-value="@lang('user.pageRegister.answer.2.4')" type="is-danger"> @lang('user.pageRegister.answer.2.4') </b-radio>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                       
                                                    @elseif($question->id == 3)
                                                        <div class="columns is-multiline @error('responses. ' . $key . '.answer') is-danger @enderror">
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionThird"  native-value="@lang('user.pageRegister.answer.3.1')" type="is-danger"> @lang('user.pageRegister.answer.3.1') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionThird"  native-value="@lang('user.pageRegister.answer.3.2')" type="is-danger"> @lang('user.pageRegister.answer.3.2') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionThird"  native-value="@lang('user.pageRegister.answer.3.3')" type="is-danger"> @lang('user.pageRegister.answer.3.3') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionThird" native-value="@lang('user.pageRegister.answer.3.4')" type="is-danger"> @lang('user.pageRegister.answer.3.4') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionThird" native-value="@lang('user.pageRegister.answer.3.5')" type="is-danger"> @lang('user.pageRegister.answer.3.5') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionThird" native-value="@lang('user.pageRegister.answer.3.6')" type="is-danger"> @lang('user.pageRegister.answer.3.6') </b-checkbox>
                                                                </div>
                                                            </div> 
                                                            <input type="hidden" :value="questionThird" name="responses[{{ $key }}][answer]">
                                                        </div>
                                                        
                                                        
                                                    @elseif($question->id == 4)
                                                        <div class="columns is-multiline @error('responses. ' . $key . '.answer') is-danger @enderror">
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionfourth" native-value="@lang('user.pageRegister.answer.4.1')" type="is-danger"> @lang('user.pageRegister.answer.4.1') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionfourth" native-value="@lang('user.pageRegister.answer.4.2')" type="is-danger"> @lang('user.pageRegister.answer.4.2') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionfourth" native-value="@lang('user.pageRegister.answer.4.3')" type="is-danger"> @lang('user.pageRegister.answer.4.3') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionfourth"  native-value="@lang('user.pageRegister.answer.4.4')" type="is-danger"> @lang('user.pageRegister.answer.4.4') </b-checkbox>
                                                                </div>
                                                            </div>
                                                            <div class="column is-one-third pb-0">
                                                                <div class="field">
                                                                    <b-checkbox v-model="questionfourth"  native-value="@lang('user.pageRegister.answer.4.5')" type="is-danger"> @lang('user.pageRegister.answer.4.5') </b-checkbox>
                                                                </div>
                                                            </div>  
                                                            <input type="hidden" :value="questionfourth" name="responses[{{ $key }}][answer]">     
                                                        </div>
                                                    @else
                                                    
                                                        <div class="field">
                                                            <b-radio v-model="radio.questionfifth" @click.native="answerCheck = 'yes'" native-value="yes" type="is-danger"> @lang('user.pageRegister.answer.5.yes') </b-radio>
                                                            <b-radio v-model="radio.questionfifth" @click.native="answerCheck = 'no'" native-value="no" type="is-danger"> @lang('user.pageRegister.answer.5.no') </b-radio>
                                                        </div>
                                                    
                                                        <div class="field" v-if="answerCheck == 'yes'">
                                                            <p class="mb-1"> @lang('user.pageRegister.answer.5.yeslabelCheck')</p>
                                                            <input id="aq-{{ $i }}"  name="responses[{{ $key }}][answer]" type="text" placeholder="@lang('user.pageRegister.input.answer')*" class="input @error('responses. ' . $key . '.answer') is-danger @enderror" :value="oldValueYes" autocomplete>
                                                        </div>
                                                        <div class="field" v-if="answerCheck == 'no'">
                                                            <input id="aq-{{ $i }}"  name="responses[{{ $key }}][answer]" type="hidden" class="input @error('responses. ' . $key . '.answer') is-danger @enderror" value="@lang('user.pageRegister.answer.5.no')" autocomplete>
                                                        </div>
                                                      
                                                   
                                                    @endif
                                                    <input type="hidden" name="responses[{{ $key }}][signup_question_id]" value="{{ $question->id }}">
                                                </div>
                                                @error('responses.' . $key . '.answer')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror
                                                @error('responses.' . $key . '.signup_question_id')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endforeach
                                        
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
                                          
                                                <div class="select is-fullwidth is-multiple" :class="{ 'is-loading': isLoading}">
                                                    <select id="store" class="form-control select2 @error('store') is-invalid @enderror" name="store[]" multiple="multiple" data-placeholder="@lang('user.pageRegister.input.restaurent')" style="width: 100%">
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

    @php 
        $oldValueYes = '';
        $check = '';
    @endphp
    @if(old('responses'))
            @if(array_key_exists('answer', old('responses.4')))
            @if(old('responses.4.answer') == 'no' || old('responses.4.answer') == 'Không')
                @php 
                
                    $check = 'no';
                @endphp
            @else
                @php 
                    $oldValueYes = old('responses.4.answer');
                    $check = 'yes';
                @endphp

            @endif
        @endif
    @endif
@endsection
@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
                    isLoading: false,
                    dateBirth: @if(old("raw_date_birth")) new Date('{{ old("raw_date_birth") }}') @else [] @endif,
                    showWeekNumber: false,
                    locale: '{{ app()->getLocale() }}',
                    radio: {
                        questionone: "{{ old('responses.0.answer') }}",
                        questiontwo: '{{ old("responses.1.answer") }}',
                        questionfifth: '{{ $check }}',
                    },
                    answerCheck: '{{ $check }}',
                    questionThird: @if(old("responses.2.answer")) '{{ old("responses.2.answer") }}'.split(',') @else [] @endif,
                    questionfourth: @if(old("responses.3.answer")) '{{ old("responses.3.answer") }}'.split(',') @else [] @endif,
                    oldValueYes: '{{ $oldValueYes }}'

                },
                computed: {
                    // sampleFormat() {
                    //     const dtf = new Intl.DateTimeFormat(this.locale, { timezome: 'UTC' })
                    //     return dtf.format(new Date(2000, 11, 25, 12))
                    // }
                },
                watch: {
                    isLoading: _.debounce(function(){
                        this.isLoading = false;
                    }, 500)
                },
                mounted () {
                    
                    this.getCategory();
                    this.getBrand();
                    this.getRestaurent();
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
                        vm.restaurents = '';
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
            $('.select2').select2()
      
    </script>
@endpush