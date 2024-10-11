@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">



@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Monthly report 2</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">report</li>
                        </ol>
                    </div>
                </div>
              
                <div class="row">
                    <!-- Default box -->
                    <div class="col-12 mb-2 mt-2">
                        
                        
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body backend-report">
                                <div class="wrap__report d-flex">
                                <div class="questions">
                                    <div class="header__question">
                                        Questions
                                    </div>
                                    <div class="inner_questions">
                                        @php 
                                                $i = 0;
                                                $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g');
                                        @endphp
                                        @foreach($groupQuestions as $group)
                                        <div class="question_group_name">
                                            <p><strong>{{ $group->translate()->title }}</strong></p>
                                        </div>
                                        @foreach($group->questions as $question)
                                            @php $i = $i + 1 @endphp
                                            @if($question->type == 'yn')
                                                <div class="question_name question-ys">
                                                    <p>
                                                        <span class="question__number">{{ $i }} .</span> 
                                                        {{ $question->translate()->question }}
                                                    </p>
                                                </div>

                                            @else
                                                <div class="question_name question-choice">
                                                    <p>
                                                        <span class="question__number">{{ $i }} .</span> 
                                                        {{ $question->translate()->question }}
                                                    </p>

                                                   
                                                </div>
                                                @foreach( $question->answers as $key => $answer)
                                                <div class="question_name question-choice">
                                                    <p>
                                                        <span class="question__number">{{ $chars[$key] }} .</span> 
                                                        {{ $answer->translate()->answer }}
                                                    </p>

                                                   
                                                </div>
                                                @endforeach
                                            @endif
                                            
                                        @endforeach
                                        
                                    @endforeach
                                    </div>
                                    <div class="question__footer">
                                        <div class="sub_row">
                                            <p>Pass/Fail each audit</p>
                                        </div>
                                        <div class="sub_row">
                                            <p>Pass/Fail total for month</p>
                                        </div>
                                        <div class="sub_row">
                                            <p>Scores</p>
                                        </div>
                                        <div class="sub_row">
                                            <p>Manager</p>
                                        </div>
                                        <div class="sub_row">
                                            <p>Server</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="reports">
                                        <div class="inner__report d-flex">
                                                @foreach($brandWithSurveys as $key => $brand)
                                                        <div class="wrap-brand  d-flex">
                                                            <div class="brand">
                                                                <div class="brand__header">
                                                                    <p>{{ $brand->name }}</p>
                                                                </div>
                                                                <div class="brand_content d-flex">
                                                                    @foreach($brand->stores as $store)
                                                                        <div class="wrap-store">
                                                                            <div class="store">
                                                                                <div class="store__header">
                                                                                    <p>{{ $store->code }}</p>
                                                                                </div>
                                                                                <div class="store_content d-flex">
                                                                                    @foreach($store->surveys as $survey)
                                                                                        <div class="wrap-survey">
                                                                                            <div class="survey">
                                                                                                @foreach($survey->responses as $key => $answers)                                                                                               
                                                                                                        <div class="space"></div>                                                                                                   
                                                                                                        @foreach($answers as $answer)
                                                                                                            <div class="answers">
                                                                                                                @if($answer->question->type == 'yn')
                                                                                                                    <div class="wrap-answer-yn">
                                                                                                                        <div class="answer answer-no">{{ $answer->key == 'no' ? 'x' : '' }}</div>
                                                                                                                    </div>
                                                                                                                @else
                                                                                                                    <div class="wrap-answer-choice">
                                                                                                                            <div class="choices">
                                                                                                                                <div class="question-choice"></div>
                                                                                                                            </div>
                                                                                                                            <div class="choices">
                                                                                                                                <div class="answer answer-choice-1">{{ $answer->key == 'answer_1' ? 'x' : '' }}</div>
                                                                                                                            </div>
                                                                                                                            <div class="choices">
                                                                                                                                <div class="answer answer-choice-2">{{ $answer->key == 'answer_2' ? 'x' : '' }}</div>
                                                                                                                            </div>
                                                                                                                            <div class="choices">
                                                                                                                                <div class="answer answer-choice-3">{{ $answer->key == 'answer_3' ? 'x' : '' }}</div>
                                                                                                                            </div>
                                                                                                                    </div>                                                                                                       
                                                                                                                @endif                                                                                                                                                                                                                             
                                                                                                            </div>
                                                                                                        @endforeach                                                                                                  
                                                                                                @endforeach
                                                                                                <div class="footer__survey">
                                                                                                    <div>
                                                                                                        <p>{{ $survey->total_point >= 85 ? 'P' : 'F' }}</p>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <p>123</p>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <p>{{ $survey->total_point }}</p>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <p>{{ $survey->manager_name }}</p>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <p>{{ $survey->staff_name }}</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                    <div class="footer__store">
                                                                                        <div>
                                                                                            <p>{{ $store->surveyPointSum[0]->aggregate }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="brand__for-month">
                                                                        <div class="brand_total">
                                                                            <div class="q__report_yes"><p>% yes</p></div>
                                                                            <div class="q__report_yes"><p>% No</p></div>
                                                                        </div>
                                                                        @foreach($brand->questionReport as $key => $groupQuestion)
                                                                            <div class="space"></div>
                                                                            @foreach($groupQuestion->questions as $q)

                                                                                @if($q->type == 'yn')
                                                                                <div class="wrap__q question-report-yn">
                                                                                    <div class="q__report">
                                                                                        <p>{{ ($q->responseSum[0]->yes_count / $q->responseSum[0]->total_count) * 100 . '%'}}</p>
                                                                                    </div>
                                                                                    <div class="q__report">
                                                                                        <p>{{ ($q->responseSum[0]->no_count / $q->responseSum[0]->total_count) * 100 . '%'}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                   
                                                                                @else
                                                                                <div class="question-report-choice">
                                                                                    <div class="space__choice q__report"></div>
                                                                                    <div class="choices__report wrap__q">
                                                                                        <div class="choice__left">
                                                                                            
                                                                                            <div class="choice-1 q__report">
                                                                                                <p>{{ ($q->responseSum[0]->answer1_count / $q->responseSum[0]->total_count) * 100 . '%' }}</p>
                                                                                            </div>
                                                                                            <div class="choice-2 q__report">
                                                                                                <p>{{ ($q->responseSum[0]->answer2_count / $q->responseSum[0]->total_count)  * 100 . '%'}}</p>
                                                                                            </div>
                                                                                            <div class="choice-3 q__report">
                                                                                                <p>{{ ($q->responseSum[0]->answer3_count / $q->responseSum[0]->total_count)  * 100 . '%'}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="choice__right">
                                                                                            <div class="disabled"></div>
                                                                                            <div class="disabled"></div>
                                                                                            <div class="disabled"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                        </div>
                                    </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
{{-- 
    @php 
        $dateFrom = explode("-", $dateFrom);
        $dateTo = explode("-", $dateTo);
        $jsDateFrom = $dateFrom[2] . '/' . $dateFrom[1] . '/' .$dateFrom[0];
        $jsDateTo = $dateTo[2] . '/' . $dateTo[1] . '/' .$dateTo[0];

       
    @endphp --}}
@endsection
@push('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

{{-- 
    <script>
        $('#reservation').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxDate: new Date(),
            startDate: '{{ $jsDateFrom }}',
            endDate: '{{ $jsDateTo }}'
        })

    </script> --}}

@endpush
