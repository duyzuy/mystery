
<table>
    <tr>
        <td>Brand</td>
        <td>{{ $brandReport->name }}</td>
       
    </tr>
    <tr>
        <td>From  </td>
        <td>{{  $dateFrom }}</td>
    </tr>
    <tr>
        <td>To</td>
        <td>{{ $dateTo }}</td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <td>Questions</td>
            <td>Yes</td>
            <td>No</td>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
            $chars = ['a', 'b', 'c', 'd'];
        @endphp
        @foreach($groupQuestions as $key => $group)
            <tr>
                <td colspan="3">{{ $group->title }}</td>
            </tr>
            
            @foreach($group->questions as $question)
            @php
                $i++;
            @endphp
                @if($question->type == 'yn')
                <tr>
                    <td>{{ $i }} . {{ $question->question }}</td>
                    <td align="center">{{ round(@($question->responseSum[0]->yes_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                    <td align="center">{{ round(@($question->responseSum[0]->no_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                </tr>
                @else
                <tr>
                    <td colspan="3">{{ $i }} . {{ $question->question }}</td>
                </tr>
                    @foreach($question->answers as $answer_key => $answer)
                        <tr>
                            <td>{{ $chars[$answer_key] . ' . ' . $answer->translate()->answer }}</td>
                            @if($answer_key == 0)
                                <td align="center" colspan="2">{{ round(@($question->responseSum[0]->answer1_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                            @elseif($answer_key == 1)
                                <td align="center" colspan="2">{{ round(@($question->responseSum[0]->answer2_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                            @else
                                <td align="center" colspan="2">{{ round(@($question->responseSum[0]->answer3_count / $question->responseSum[0]->total_count), 2) * 100 . '%' }}</td>
                            @endif
                        </tr>
                    @endforeach
              
                @endif
            @endforeach
        @endforeach
        <tr>

        </tr>
    
       
    </tbody>
    <tfoot>
       
     </tfoot>
</table>