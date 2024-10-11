<table>
    <tr>
        <td>Region:</td>
        <td>{{ $region }}</td>
    </tr>
    <tr>
        <td>Brand:</td>
        <td>{{ $brand }}</td>
    </tr>
    <tr>
        <td>Restaurant:</td>
        <td>{{ $restaurant }}</td>
    </tr>
    <tr>
        <td>Date From:</td>
        <td>{{ $dFrom }}</td>
    </tr>
    <tr>
        <td>Date To:</td>
        <td>{{ $dTo }}</td>
    </tr>
</table>


<table class="table table-bordered dataTable no-footer dtr-inline table-report">
    <thead>
        <tr>
            <th rowspan="2" style="vertical-align: middle; text-align: center">Questions</th>
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
                    <th align="center" class="text-center" colspan="{{ $surveyCount }}">{{ ($surveyPoint > (85 * $surveyCount)) ? 'P' : "F" }}</th>
                   
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
                   <th align="center" class="text-center" colspan="{{ $surveyCount }}">{{ $surveyPoint/$surveyCount }}</th>
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