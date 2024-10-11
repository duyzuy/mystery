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
                        <h1>Report From {{ $dateFrom . ' to ' . $dateTo }}</h1>
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
                        <form action="{{ route('manage.report.monthly.show') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Questionaire</label>
                                        <select name="questionnaire" id="questionnaire" class="form-control form-control-sm @error('questionnaire') is-invalid @enderror">
                                            <option value="">Select questionnaire</option>
                                            @foreach ($questionnaires as $questionnaire)
                                                <option {{ $questionnaire->id == $questionnaireId ? 'selected': '' }} value="{{ $questionnaire->id }}">{{ $questionnaire->translate('en')->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('questionnaire')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Region</label>
                                    
                                        <select name="region" id="region" class="form-control form-control-sm  @error('region') is-invalid @enderror">
                                            <option value="all">All</option>
                                            @foreach($regions as $key => $region)
                                                <option {{ $region->id == $regionFilter ? 'selected' : '' }} value="{{ $region->id }}">{{ $region->translate('en')->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select name="brand" id="brand" class="form-control form-control-sm  @error('brand') is-invalid @enderror">
                                            <option value="all">All</option>
                                            @foreach($brands as $key => $brand)
                                                <option {{ $brand->id == $brandFilter ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Restaurants</label>
                                        <select name="restaurant" id="restaurant" class="form-control form-control-sm  @error('restaurant') is-invalid @enderror">
                                            <option value="all">All</option>
                                            @foreach($cities as $city)
                                              <optgroup label="{{ $city->translate()->name }}">
                                                @foreach($city->stores as $key => $restaurant)
                                                    <option {{ $restaurant->id == $restaurantFilter ? 'selected' : '' }} value="{{ $restaurant->id }}">{{ $restaurant->translate()->store_name }}</option>
                                                @endforeach
                                              </optgroup>
                                            @endforeach
                                        </select>
                                        @error('restaurant')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Date:</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="date" class="form-control form-control-sm float-right @error('date') is-invalid @enderror" id="reservation">
                                            @error('date')
                                                <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <!-- /.input group -->
                                    </div>
                          
                            </div>
                                <div class="col col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label>Answer mark for report:</label>
                                        <select name="answer_type" id="typeanswer" class="form-control form-control-sm @error('answer_type') is-invalid @enderror">
                                            <option value="">Select Answer type</option>
                                            <option {{ $answerType == 'yes' ? 'selected' : '' }} value="yes">Answer with "Yes" mark</option>
                                            <option {{ $answerType == 'no' ? 'selected' : '' }} value="no">Answer with "No" mark</option>
                                        </select>
                                        @error('answer_type')
                                            <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col d-flex align-items-end">
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Filter</button>
                                    </div>
                                   
                                </div>
                            </div>
                        </form>
                        
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p class="mb-0">Report for "{{ $answerType }}" answer mark</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="mb-0 text-right">
                                            <a href="{{ route('manage.export.monthly', [$questionnaireId, $regionFilter, $brandFilter, $restaurantFilter, $dateFrom, $dateTo, $answerType]) }}" class="btn btn-info">Export</a>
                                        </p>
                                    </div>
                                </div>
                               
                               
                            </div>
                            <div class="card-body backend-report" style="overflow-y: scroll;">
                                <div class="wrap__report d-flex">
                                <div>
                                    <table class="table table-bordered dataTable no-footer dtr-inline table-report">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; text-align: center; min-width: 600px !important;">Questions</th>
                                                    @php $totalSurvey = 0 @endphp
                                                    @foreach($brandWithSurveys as $key => $brand)
                                                        @php $totalSurvey += count($brand->surveys) @endphp
                                                        <th colspan="{{ count($brand->surveys) }}" align="center" style="vertical-align: center; text-align: center">{{ $brand->name }}</th>
                                                    @endforeach
                                            </tr>
                                            <tr>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        <th colspan="{{ count($store->surveys) }}" rowspan="1" align="center" style="vertical-align: center; text-align: center">{{ $store->code }}</th>
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                                $i = 0;
                                                $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g');
                                            @endphp
                                            @foreach($groupQuestions as $group)
                                                <tr class="question__group">
                                                    <th colspan="{{ count($group->questions[0]->responses) + 1 }}">{{ $group->translate()->title }}</th>
                                                </tr>
                                                @foreach($group->questions as $question)
                                                    @php $i = $i + 1 @endphp
                                                    @if($question->type == 'yn')
                                                        <tr class="question__name question__yn">
                                                            <td>
                                                                <span class="question__number">{{ $i }}. </span> 
                                                                {{ $question->translate()->question }}
                                                            </td>
                                                            @foreach($question->responses as $respone)
                                                                <td align="center">{{ $respone->key == $answerType ? 'x' : '' }}</td>
                                                            @endforeach
                                                        </tr>
        
                                                    @else
                                                        <tr class="question_name question__choice">
                                                            <td>
                                                                <span class="question__number">{{ $i }} .</span> 
                                                                {{ $question->translate()->question }}
                                                            </td>
                                                            @foreach($question->responses as $respone)
                                                                @if($respone->key == 'answer_1')
                                                                    <td align="center" rowspan="4" style="vertical-align: middle;">a</td>
                                                                @elseif($respone->key == 'answer_2')
                                                                    <td align="center" rowspan="4" style="vertical-align: middle;">b</td>
                                                                @else
                                                                    <td align="center" rowspan="4" style="vertical-align: middle;">c</td>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                        @foreach( $question->answers as $key => $answer)
                                                            <tr class="question_name question-choice">
                                                                <td>
                                                                    <span class="question__number">{{ $chars[$key] }} .</span> 
                                                                    {{ $answer->translate()->answer }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach   
                                            @endforeach
                                        
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-right">Pass/Fail each audit</th>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        @foreach($store->surveys as $survey)
                                                        <th class="text-center">{{ ($survey->total_point > 85) ? 'P' : 'F'  }}</th>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="text-right">Pass/Fail total for month</th>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        @php 
                                                            $surveyCount = $store->surveyPointSum[0]->totalSurvey;
                                                            $surveyPoint = $store->surveyPointSum[0]->aggregate
                                                        @endphp
                                                        <th align="center" class="text-center" colspan="{{ $surveyCount }}">{{ ($surveyPoint > (85 * $surveyCount)) ? "P" : "F" }}</th>
                                                       
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="text-right">Scores each audit</th>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        @foreach($store->surveys as $survey)
                                                            <th class="text-center">{{ $survey->total_point }}</th>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="text-right">Scores total</th>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        @php 
                                                            $surveyCount = $store->surveyPointSum[0]->totalSurvey;
                                                            $surveyPoint = $store->surveyPointSum[0]->aggregate
                                                        @endphp
                                                       <th align="center" class="text-center" colspan="{{ $surveyCount }}">{{ $surveyPoint/$surveyCount}}</th>
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="text-right">Manager</th>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        @foreach($store->surveys as $survey)
                                                        <th class="text-center">{{ $survey->manager_name }}</th>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th class="text-right">Server</th>
                                                @foreach($brandWithSurveys as $key => $brand)
                                                    @foreach($brand->stores as $store)
                                                        @foreach($store->surveys as $survey)
                                                        <th class="text-center">{{ $survey->staff_name }}</th>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                         </tfoot>
                                    </table>
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

    @php 
        $dateFrom = explode("-", $dateFrom);
        $dateTo = explode("-", $dateTo);
        $jsDateFrom = $dateFrom[2] . '/' . $dateFrom[1] . '/' .$dateFrom[0];
        $jsDateTo = $dateTo[2] . '/' . $dateTo[1] . '/' .$dateTo[0];

    @endphp
 
   
@endsection
@push('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>


    <script>
         $('#reservation').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxDate: new Date(),
            startDate: '{{ $jsDateFrom }}',
            endDate: '{{ $jsDateTo }}'
        })

    </script>

@endpush
