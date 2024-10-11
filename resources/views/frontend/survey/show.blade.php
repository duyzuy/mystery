@extends('frontend.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<style>
    textarea {
      resize: none;
    }
    .morecontent:not(.show){
        display: none;
       
    }
    .morecontent{
        padding: 10px 0;
    }
    .list-by-group, .list-by-question{
        list-style-type: none;
        padding: 0;
    }
    .list-by-question .question p{
        font-weight: bold
    }
    .list-by-question .question p span{

    }
    h4.group__label{
        background: #f1f1f1;
        padding: 15px 1.5rem;
        margin: 1.5rem -1.5rem;
        /* margin-left: -1.5rem;
        margin-right: -1.5rem; */
        font-weight: bold;
        text-transform: uppercase
    }
    .datepicker-cell.is-week-number{
        color: #E91E63;
    }
    .card__survey .card-content{
        padding: 1.5rem
    }
    .jserror{
        position: absolute;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);
        border-radius: 5px;
        padding: 1rem;
        font-size: .8rem;
        z-index: 99;
    }
    textarea{
        resize: none !important
    }
    </style>
@endpush
@section('content')

<section class="hero is-primary survey__header">
    <div class="hero-body">
      <div class="container">
        <h1 class="title has-text-centered">
            {!! $questionnaire->translate()->title !!}
        </h1>
      </div>
    </div>
  </section>
<section class="section">
    <div class="container">

        <div class="container-survey">
            <div class="survey__description">
               {!! $questionnaire->translate()->description !!}
            </div>
            
                <form method="POST" action="{{ route('user.survey.store', [ app()->getlocale(), $questionnaire->id, Str::slug($questionnaire->translate()->title), $index]) }}">
                    @csrf
                 
                    
                    <div class="card card__survey">
                     
                        <div class="card-content">
                            <div class="columns">
                                <div class="column is-one-third">
                                    <div class="field">
                                        <div class="control is-fullwidth">
                                            <label class="label" for="restaurentName">@lang('user.label.restaurentName')</label>
                                            <div class="select is-fullwidth @error('restaurent') is-danger @enderror">
                                                <select id="restaurentName" name="restaurantName" disabled  v-model="restaurantInform.restaurantId">
                                                    <option value="{{ $restaurent->id }}" selected>{{ $restaurent->translate()->store_name }}</option>
                                                </select>
                                                <input type="hidden" value="{{ $restaurent->id }}" name="restaurent">
                                                <input type="hidden" value="{{ $restaurent->brand->id }}" name="brand">
                                                <input type="hidden" value="{{ $restaurent->city->id }}" name="city">
                                                <input type="hidden" value="{{ $restaurent->city->region->id }}" name="region">
                                                @error('restaurent')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                       
                                <div class="column is-one-third">
                                        <div class="field">
                                            <div class="control">
                                                <label class="label" for="restaurentAddress">@lang('user.label.addressTitle')</label>
                                                <input type="text" id="restaurentAddress" class="input @error('address') is-danger @enderror" disabled value="{{ $restaurent->translate()->store_address }}" placeholder="@lang('user.input.address')">
                                                    {{--<input type="text" id="restaurentAddress" name="address" class="input @error('address') is-danger @enderror" value="{{ old('address') }}" placeholder="@lang('user.input.address')"> --}}
                                                @error('address')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="column is-one-third">
                                    <div class="field"> 
                                        <div class="control">
                                            <label class="label" for="receipt">@lang('user.label.receipt')</label>
                                            <b-receipt
                                            invalid="@error('receipt') is-danger @enderror"
                                            placeholder="@lang('user.input.receipt')"
                                            lang = "{{ app()->getLocale() }}"
                                            oldreceipt="{{ old('receipt') }}"
                                            @receipt-value="updateReceipt"
                                            :restaurantcode="restaurantCode"
                                            value="{{ old('receipt') }}"
                                            ></b-receipt>
                                            
                                            <input type="hidden" name="receipt" id="receipt" :value="receiptValue">
                                           
                                            @error('receipt')
                                                <p class="help is-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column is-one-third">
                                    <div class="field">
                                        <div class="control">
                                            <b-field label="@lang('user.label.timeTitle')" @error('restaurent_time') type="is-danger" @enderror>
                                              
                                                <b-datetimepicker
                                                    placeholder="@lang('user.label.timePlaceholder')"
                                                    icon="calendar-day"
                                                    rounded
                                                    {{-- :datepicker="{showWeekNumber}" --}}
                                                    :max-datetime="maxDatetime"
                                                    v-model="datetime"
                                                    :locale="locale"
                                                    >
                                                    <template slot="left">
                                                        <span class="">
                                                            <b-icon icon="clock"></b-icon>
                                                            <span>Hour</span>
                                                        </span>
                                                    </template>
                                                </b-datetimepicker>
                                            </b-field>
                                            <input type="hidden" name="restaurent_time" :value="datetimeConvert">
                                            <input type="hidden" name="raw_time" :value="datetime">

                                            {{-- <input type="date" id="restaurentTime" name="time" value="{{ old('time') }}" class="input @error('time') is-danger @enderror"> --}}
                                            @error('restaurent_time')
                                                <p class="help is-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div> 
                                </div>
                                
                                <div class="column is-one-third">
                                        <div class="field"> 
                                            <div class="control">
                                                <label class="label" for="restaurentManage">@lang('user.label.managerName')</label>
                                                <input type="text" id="restaurentManage" name="manage_name" value="{{ old('manage_name') }}" class="input @error('manage_name') is-danger @enderror" placeholder="@lang('user.input.managerName')">
                                                @error('manage_name')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="column is-one-third">
                                        <div class="field">
                                            <div class="control">
                                                <label class="label" for="restaurentStaff">@lang('user.label.staffName')</label>
                                                <input type="text" id="restaurentStaff" name="staff_name" value="{{ old('staff_name') }}" v-model="restaurantInform.staffName" class="input @error('staff_name') is-danger @enderror" placeholder="@lang('user.input.staffName')">
                                                @error('staff_name')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <ul class="question__lists list__by__group">
                            
                                @php $questionIndex = 0; @endphp
                                @foreach($allQuestions as $groupIndex => $group)
                                    <h4 class="group__label">{{ $group['group']->translate()->title }}</h4>
                                    <ul class="list-by-question list-question-{{ $groupIndex + 1 }}">

                                        @foreach($group['questions'] as $key => $question)
                                           
                                          
                                            <li class="question question-{{ $questionIndex + 1 }} mb-4">
                                                
                                                <p class="question__title"><span>{{ $questionIndex + 1  }}.</span> {{ $question->translate()->question }}</p>
                                                @error('responses.' . $questionIndex . '.answer_id')
                                                    <p class="help is-danger">{{ $message }}</p>
                                                @enderror

                                                @foreach($question->answers as $answer)
                                                    <div class="form-group">
                                                        <b-radio v-model="answer.question{{ $questionIndex }}"
                                                            native-value="{{ $answer->id }}"
                                                            type="is-success"
                                                            name="responses[{{ $questionIndex }}][answer_id]"
                                                            class="is-capitalized"
                                                            >
                                                            {{ $answer->translate()->answer }}
                                                        </b-radio>
                                                        {{-- @if($answer->show_textarea == true)
                                                            <b-radio v-model="answer.question{{ $questionIndex }}"
                                                                native-value="{{ $answer->id }}"
                                                                type="is-success"
                                                                @click.native="showComment.comment{{ $questionIndex }} = 'show'"
                                                                name="responses[{{ $questionIndex }}][answer_id]"
                                                                >
                                                                {{ $answer->translate()->answer }}
                                                            </b-radio>
                                                        @else
                                                            <b-radio v-model="answer.question{{ $questionIndex }}"
                                                                native-value="{{ $answer->id }}"
                                                                @click.native="showComment.comment{{ $questionIndex }} = 'hide'"
                                                                name="responses[{{ $questionIndex }}][answer_id]"
                                                                type="is-success"
                                                                >
                                                                {{ $answer->translate()->answer }}
                                                            </b-radio>
                                                        @endif --}}
                                                    </div>
                                                    
                                                @endforeach
                                                <textarea id="textContent-{{ $question->id }}" 
                                                    name="responses[{{ $questionIndex }}][descriptions]" 
                                                    class="textarea answer_more_content" 
                                                    rows="3" 
                                                    placeholder="@lang('user.input.textareaMessage')*" 
                                                    cols="50"
                                                    v-model = "comment.message{{ $questionIndex }}"
                                                    >
                                                </textarea>
                                                    @error('responses.' . $questionIndex . '.descriptions')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                @php /*
                                                <div  v-if="showComment.comment{{ $questionIndex }} == 'show'" class="morecontent show formContent-{{ $question->id }} @error('responses.' . $questionIndex . '.descriptions') show @enderror">
                                                    <textarea id="textContent-{{ $question->id }}" 
                                                        name="responses[{{ $questionIndex }}][descriptions]" 
                                                        class="textarea answer_more_content" 
                                                        rows="3" 
                                                        placeholder="@lang('user.input.textareaMessage')*" 
                                                        cols="50"
                                                        {{-- :oldComment="comment.question{{ $questionIndex }}" --}}
                                                        v-model = "comment.message{{ $questionIndex }}"
                                                        >
                                                        {{-- @{{ comment.question{{ $questionIndex }} }} --}}
                                                        {{-- {{ old('responses['.$questionIndex.'][descriptions]') }} --}}
                                                    </textarea>

                                                    @error('responses.' . $questionIndex . '.descriptions')
                                                        <p class="help is-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <input v-if="showComment.comment{{ $questionIndex }} == 'hide'" type="hidden" name="responses[{{ $questionIndex }}][descriptions]" value="n/a">
                                                */
                                                @endphp
                                              
                                            
                                                <input type="hidden" name="responses[{{ $questionIndex }}][question_id]" value="{{ $question->id }}">
                                                <input type="hidden" name="responses[{{ $questionIndex }}][group_id]" value="{{ $group['group']->id }}">
                                            </li>
                                    
                                            @php $questionIndex++; @endphp

                                        @endforeach

                                    </ul>
                                @endforeach

                            </ul>

                            <hr class="navbar-divider mt-5 mb-5">
                            <div class="field">
                                <label for="userFeedback" class="label">@lang('user.survey.anotherQuestion')</label>
                                <textarea name="user_feedback" id="userFeedback" rows="5" class="textarea">{{ old('user_feedback') }}</textarea>
                            </div>
                            <div class="field">
                                <hr class="navbar-divider mb-5 mt-5">
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
                                        <label class="label" for="name">@lang('user.pageRegister.label.bankAccount')</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input id="bank_account" type="text" class="input @error('bank_account') is-danger @enderror" name="bank_account" value="{{ old('bank_account') }}"  autocomplete="bank_account">
                                            <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                                        </div>
                                        @error('bank_account')
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
                                <div class="column">
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
                                </div>
                            </div>
                            <hr class="mb-5">
                            <div class="field mt-5 mb-5">
                                <div class="control">
                                    <button type="submit" class="button is-primary">@lang('user.survey.buttonSubmit')</button>
                                    <button type="button" class="button is-warnning" @click="previewQuestionnaire()">Preview</button>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </form>
        </div>
    </div>
</section>
@php 

$oldAnswer = '';
$oldQuestion = '';
$oldMessage = '';
$i = 0;
$ii = 0;
@endphp
    @if(old("responses")) 
       
        @foreach(old("responses") as $key => $response) 
            
            @if(array_key_exists('answer_id', $response))
               
                    @php 
                        $i = $i + 1;
                    @endphp 
                @if($i > 1)
                    @php 
                        $oldAnswer .= ', ';
                        
                    @endphp 
                @endif
      
                @php 
                    $oldAnswer .= '"' .'question' . $key  . '":' . '"' . $response['answer_id']. '"';
                   
                @endphp 
 
            @endif

            @if(array_key_exists('descriptions', $response))
                @php 
                    $ii = $ii + 1;
                @endphp 
                @if($ii > 1)
                    @php 
                        $oldQuestion .= ', ';
                        $oldMessage .= ', ';
                    @endphp 
                @endif

                @if($response['descriptions'] != 'n/a')
                    @php 
                        $oldQuestion .= '"' .'comment' . $key  . '": "show"';
                        $oldMessage .=  '"' .'message' . $key  . '":' . '"' . $response['descriptions']. '"';
                    @endphp 

                @else
                    @php 
                        $oldQuestion .= '"' .'comment' . $key  . '": "hide"';
                        $oldMessage .=  '"' .'message' . $key  . '":' . '""';
                    @endphp 
                @endif
                
            @endif
        @endforeach 
    
    @endif

@endsection
{{-- JSON.parse('@if(old("raw_time")) new Date("{{ old("raw_time") }}") @else null @endif') --}}
@push('scripts')
    <script>
      
      const app = new Vue({
          
        el: '#app',
        data: {
            datetime:  @if(old("raw_time")) new Date('{{ old("raw_time") }}') @else null @endif,
            maxDatetime: new Date(),
            showWeekNumber: true,
            timepicker: {
                incrementMinutes: 5,
                incrementHours: 1,
                enableSeconds: false,
               
            },
            restaurantCode: '{{ $restaurent->code }}',
            receiptValue: "{{ old('receipt') }}",
            locale: undefined,
            datetimeConvert: '{{ old("restaurent_time") }}',
            showComment: JSON.parse('{ {!! $oldQuestion !!} }'),
            answer: JSON.parse('{ {!! $oldAnswer !!} }'),
            comment: JSON.parse('{ {!! $oldMessage !!} }'),
            restaurantInform: {
                restaurantId: '{{  $restaurent->id  }}',
                restaurantName: '{{  $restaurent->translate()->store_name  }}',
                restaurantAddress: '',
                restaurantCode: '',
                restaurantTime: '',
                manageName: '',
                staffName: ''
            },
            questionnairs: {

            }
           
           
        },
        computed: {
            // showComment() {
            //     const dtf = new Intl.DateTimeFormat(this.locale, { timezome: 'UTC' })
            //     return dtf.format(new Date(2000, 11, 25, 12))
            // }
        },
        watch: {
            datetime: function(){
                
                const strTimePicker = this.datetime.toString();
                const mnths = {
                    Jan: "01",
                    Feb: "02",
                    Mar: "03",
                    Apr: "04",
                    May: "05",
                    Jun: "06",
                    Jul: "07",
                    Aug: "08",
                    Sep: "09",
                    Oct: "10",
                    Nov: "11",
                    Dec: "12"
                    },
                    
                    date = strTimePicker.split(" ");

                    timeValid = date[4];
                    
                    dateValid = [date[3], mnths[date[1]], date[2]].join("-");
                    dateTimeConvert = [dateValid, timeValid].join(" ");
                    this.datetimeConvert = dateTimeConvert;
            },
            showComment: function(){
                this.dynamicValue = 'oke';
            }
        },   
        methods: {
            updateReceipt: function(value){
                this.receiptValue = value;
            },
            previewQuestionnaire: function(){
                const vm = this;
                alert(vm.restaurantInform.staffName);
            }
        }

    });

    //   function showDetail(Id, InputId){
    //         // var formDetail = document.getElementById('textContent-'+Id);
    //         var formDetailClass = $('.formContent-'+Id);
    //        if( $('input[name="responses['+InputId+'][answer_id]"]').is(':checked') )
    //         {
    //             formDetailClass.addClass('show');

    //         }else{
    //             formDetailClass.removeClass('show');
           
    //         } 
    //   }

    //   function removeDetail(Id, InputId){
    //         // var formDetail = document.getElementById('textContent-'+Id);
    //         var formDetailClass = $('.formContent-'+Id);
    //        if( $('input[name="responses['+InputId+'][answer_id]"]').is(':checked') )
    //         {
    //             formDetailClass.removeClass('show');

    //         }
    //   }

    </script>
@endpush

