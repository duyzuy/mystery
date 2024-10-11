<table>
    <tbody>
        <tr>
            <th>name</th>
            <td>{{ html_entity_decode($survey->user->name)  }}</td>
        </tr>
        <tr>
            <th>email</th>
            <td>{{ html_entity_decode($survey->user->email)  }}</td>
        </tr>
        <tr>
            <th>Phone number</th>
            <td>{{ html_entity_decode($survey->user->phone_number)  }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ html_entity_decode($survey->user->address)  }}</td>
        </tr>
        <tr>
            <th>City</th>
            <td>{{ html_entity_decode($survey->store->city->name)  }}</td>
        </tr>
        <tr>
            <th>Restaurant</th>
            <td>{{ html_entity_decode($survey->store->store_name)  }}</td>
        </tr>
        <tr>
            <th>Bank name</th>
            <td>{{ html_entity_decode($survey->bank_name)  }}</td>
        </tr>
        <tr>
            <th>Account name</th>
            <td>{{ html_entity_decode($survey->beneficiary)  }}</td>
        </tr>
        <tr>
            <th>Bank number</th>
            <td>{{ html_entity_decode($survey->bank_number)  }}</td>
        </tr>
        <tr>
            <th>Bank address</th>
            <td>{{ html_entity_decode($survey->bank_address)  }}</td>
        </tr> 
        <tr>
            <th>Receipt code</th>
            <td>{{ html_entity_decode($survey->receipt_number)  }}</td>
        </tr>
        <tr>
          <th>Diner time</th>
          <td>{{ html_entity_decode($survey->dinner_time)  }}</td>
      </tr>
      <tr>
        <th>Manager</th>
        <td>{{ html_entity_decode($survey->manager_name)  }}</td>
      </tr>
      <tr>
        <th>Service</th>
        <td>{{ html_entity_decode($survey->staff_name)  }}</td>
    </tr>
    </tbody>
</table>


<table class="table ta table-bordered">
    <thead>
        <tr>
            <th>Question</th>
            <th>Yes</th>
            <th>No</th>
            <th>Feedback</th>
            <th colspan="3">scores</th>
        </tr>
    </thead>
    <tbody>
      @php 
          $i = 0;
          $pointTotal = 0;
          $pointMax = 0;
          $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i');
          $section = array();
      @endphp
        @foreach($groupQuestions as $key => $group)
            @php                              
            $groupPointActual = 0;
            $groupPointMax = 0;
          @endphp
          <tr>
            <td colspan="4" >{!! $group->title !!}</td>
            <td >Actual</td>
            <td >Max</td>
            <td >% Reach</td>
          </tr>
          
            @foreach($group->questions as $question)
            @php 
              $i = $i + 1;
            @endphp
              @if($question->type == 'yn')
                <tr class="typeYn">
                  <td>
                    <span class="question__number">{!! $i !!}. </span> 
                    {!! $question->translate()->question !!}
                  </td>
                  @foreach($question->responses as $response)
                    @php 
                      $groupPointActual += $response->point;
                      $pointTotal += $response->point;
                    @endphp
                    <td align="center" >{!! $response->key == 'yes' ? 'x' : '' !!}</td>
                    <td align="center" >{!! $response->key == 'no' ? 'x' : '' !!}</td>
                    <td>
                      {{ html_entity_decode($response->descriptions)  }}
                    </td>
                    <td align="center" >{!! $response->point !!}</td>
                    
                  @endforeach
                  @foreach($question->questionMaxPoint as $max)
                    @php 
                      $groupPointMax += $max->max_point;
                      $pointMax += $max->max_point;
                    @endphp
                    <td align="center" >{!! $max->max_point !!}</td>
                  @endforeach
                    <td></td>
                </tr>
              @else
                <tr class="question_name question__choice">
                  <td>
                      <span class="question__number">{!! $i !!} .</span> 
                      {!! $question->translate()->question !!}
                  </td>
                  @foreach($question->responses as $response)
                    @php 
                      $groupPointActual += $response->point;
                      $pointTotal += $response->point;
                    @endphp
                      @if($response->key == 'answer_1')
                          <td align="center" rowspan="4" colspan="2" >a</td>
                      @elseif($response->key == 'answer_2')
                          <td align="center" rowspan="4" colspan="2" >b</td>
                      @else
                          <td align="center" rowspan="4" colspan="2" >c</td>
                      @endif
                      <td rowspan="4" >
                        {{ html_entity_decode($response->descriptions)  }}
                      </td>
                      <td rowspan="4" align="center" >{!! $response->point !!}</td>
                  @endforeach
                  @foreach($question->questionMaxPoint as $max)
                    @php 
                      $groupPointMax += $max->max_point;
                      $pointMax += $max->max_point;
                    @endphp
                      <td rowspan="4" align="center" >{!! $max->max_point !!}</td>
                  @endforeach
                    <td rowspan="4"></td>
                </tr>
                @foreach( $question->answers as $key => $answer)
                    <tr class="question_name question-choice">
                        <td>
                            <span class="question__number">{!! $chars[$key] !!} .</span> 
                            {!! $answer->translate()->answer !!}
                        </td>
                    </tr>
                @endforeach
              @endif
            @endforeach
            <tr>
              <td colspan="4"></td>
              <td  align="center" >{!! $groupPointActual !!}</td>
              <td  align="center" >{!! $groupPointMax !!}</td>
              <td  align="center" >{!! round(@($groupPointActual/$groupPointMax) * 100, 2) . '%' !!}</td>
            </tr>
            @php 
              $section[$key]['point'] = $groupPointActual;
              $section[$key]['percent'] = round(@($groupPointActual/$groupPointMax) * 100, 2);
            @endphp
        @endforeach
        <tr>
          <td colspan="4">Total</td>
          <td align="center" >{!! $pointTotal !!}</td>
          <td align="center" >{!! $pointMax !!}</td>
          <td align="center" >{!! round(@($pointTotal/$pointMax) * 100, 2) . '%' !!}</td>
        </tr>
        <tr>
          <td colspan="4">Other comments</td>
          <td align="center" >Section</td>
          <td align="center" >Scores</td>
          <td align="center" >%</td>
        </tr>
        @foreach($section as $k => $sec)
          <tr>
            @if($k == 0)
            <td rowspan="8" colspan="4">
              {{ html_entity_decode($survey->feedback)  }}
            </td>
            @endif
            <td align="center" >{!! $chars[$k] !!}</td>
            <td align="center" >{!! $sec['point'] !!}</td>
            <td align="center" >{!! $sec['percent'] . '%' !!}</td>
          </tr>
        @endforeach
    </tbody>
</table>