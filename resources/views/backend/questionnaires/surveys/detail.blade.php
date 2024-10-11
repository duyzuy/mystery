@extends('layouts.app')

@push('styles')

  <style>
 
  </style>
@endpush
@section('content')

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Response detail</h1>
              </div>
              <div class="col-sm-6">
               <p class="float-sm-right">
                 <a href="{{ route('manage.export.response', $survey->id) }}" class="btn btn-info mr-2">Export</a>
                 <a href="{{ route('manage.survey.edit', [$survey->user->id, $survey->id]) }}" class="btn btn-danger mr-2">Edit</a>
                 <a href="{{ route('manage.survey.responses') }}" class="btn btn-primary">Back</a>
               </p>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
              
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                
    
                    <h3 class="profile-username text-center mb-3">{{ $survey->user->name }}</h3>
    
    
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $survey->user->email }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Phone</b> <a class="float-right">{{ $survey->user->phone_number }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Address</b> <a class="float-right">{{ $survey->user->address }}</a>
                      </li>
                    </ul>
                  </div>
                  
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Survey detail</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-file-alt mr-1"></i> Questionnaire</strong>
    
                    <p class="text-muted">
                        {{ $survey->questionnaire->title }}
                    </p>
    
                    <hr>
                    <strong><i class="fas fa-utensils mr-1"></i> Store</strong>
                    <p class="text-muted mb-0">City: {{ $survey->store->city->name }}</p>
                    <p class="text-muted mb-0">Store: {{ $survey->store->store_name }}</p>
                    <p class="text-muted">Address: {{ $survey->store->store_address }}</p>
                    <hr>
                    <strong><i class="fas fa-user-friends mr-1"></i> Staff</strong>
                    <p class="text-muted mb-0">Manager: {{ $survey->manager_name }}</p>
                    <p class="text-muted mb-0">Service: {{ $survey->staff_name }}</p>
                    <hr>
                    <strong><i class="fas fa-qrcode mr-1"></i> Information payment</strong>
                    <ul class="list-group list-group-unbordered mb-3">
                        
                        <li class="list-group-item text-muted" style="border-top: none">
                          <b>Bank name</b> <a class="float-right">{{ $survey->bank_name }}</a>
                        </li>
                        <li class="list-group-item text-muted" style="border-top: none">
                          <b>Account name</b> <a class="float-right">{{ $survey->beneficiary }}</a>
                        </li>
                        <li class="list-group-item text-muted">
                          <b>Bank number</b> <a class="float-right">{{ $survey->bank_number }}</a>
                        </li>
                        <li class="list-group-item text-muted">
                          <b>Bank address</b> <a class="float-right">{{ $survey->bank_address }}</a>
                        </li>
                        <li class="list-group-item text-muted">
                            <b>Receipt code</b> <a class="float-right">{{ $survey->receipt_number }}</a>
                        </li>
                        <li class="list-group-item text-muted" style="border-bottom: none">
                            @php
                                $dinnerTime = new TimeFormat($survey->dinner_time)   
                            @endphp
                            <b>Diner time</b> <a class="float-right">{{ $dinnerTime->getTime() }}</a>
                        </li>
                      </ul>
                   
                    <hr>
                    <strong><i class="far fa-comment-dots"></i> Other comments</strong>
                    <p class="text-muted">{{ $survey->feedback }}</p>
                    <hr>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Response detail</h3>
                  </div><!-- /.card-header -->
                  <div class="card-body" style="font-size: .9rem">
                    <table class="table ta table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 40%">Question</th>
                                <th style="width: 5%">Yes</th>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Feedback</th>
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
                                <td colspan="4" style="background: #f1f1f1">{{ $group->title }}</td>
                                <td style="background: #f1f1f1">Actual</td>
                                <td style="background: #f1f1f1">Max</td>
                                <td style="background: #f1f1f1">% Reach</td>
                              </tr>
                              
                                @foreach($group->questions as $question)
                                @php 
                                  $i = $i + 1;
                                @endphp
                                  @if($question->type == 'yn')
                                    <tr class="typeYn">
                                      <td>
                                        <span class="question__number">{{ $i }}. </span> 
                                        {{ $question->translate()->question }}
                                      </td>
                                      @foreach($question->responses as $response)
                                        @php 
                                          $groupPointActual += $response->point;
                                          $pointTotal += $response->point;
                                        @endphp
                                        <td align="center" style="vertical-align: middle;" >{{ $response->key == 'yes' ? 'x' : '' }}</td>
                                        <td align="center" style="vertical-align: middle;" >{{ $response->key == 'no' ? 'x' : '' }}</td>
                                        <td>{{ $response->descriptions }}</td>
                                        <td align="center" style="vertical-align: middle;" >{{ $response->point }}</td>
                                        
                                      @endforeach
                                      @foreach($question->questionMaxPoint as $max)
                                        @php 
                                          $groupPointMax += $max->max_point;
                                          $pointMax += $max->max_point;
                                        @endphp
                                        <td align="center" style="vertical-align: middle;" >{{ $max->max_point }}</td>
                                      @endforeach
                                        <td></td>
                                    </tr>
                                  @else
                                    <tr class="question_name question__choice">
                                      <td>
                                          <span class="question__number">{{ $i }} .</span> 
                                          {{ $question->translate()->question }}
                                      </td>
                                      @foreach($question->responses as $response)
                                        @php 
                                          $groupPointActual += $response->point;
                                          $pointTotal += $response->point;
                                        @endphp
                                          @if($response->key == 'answer_1')
                                              <td align="center" style="vertical-align: middle;" rowspan="4" colspan="2" style="vertical-align: middle;">a</td>
                                          @elseif($response->key == 'answer_2')
                                              <td align="center" style="vertical-align: middle;" rowspan="4" colspan="2" style="vertical-align: middle;">b</td>
                                          @else
                                              <td align="center" style="vertical-align: middle;" rowspan="4" colspan="2" style="vertical-align: middle;">c</td>
                                          @endif
                                          <td rowspan="4" style="vertical-align: middle;">{{ $response->descriptions }}</td>
                                          <td rowspan="4" align="center" style="vertical-align: middle;">{{ $response->point }}</td>
                                      @endforeach
                                      @foreach($question->questionMaxPoint as $max)
                                        @php 
                                          $groupPointMax += $max->max_point;
                                          $pointMax += $max->max_point;
                                        @endphp
                                          <td rowspan="4" align="center" style="vertical-align: middle;" >{{ $max->max_point }}</td>
                                      @endforeach
                                        <td rowspan="4"></td>
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
                                <tr>
                                  <td colspan="4"></td>
                                  <td  align="center" style="vertical-align: middle;" >{{ $groupPointActual }}</td>
                                  <td  align="center" style="vertical-align: middle;" >{{ $groupPointMax }}</td>
                                  <td  align="center" style="vertical-align: middle;" >{{ @round($groupPointActual/$groupPointMax * 100, 2) . '%' }}</td>
                                </tr>
                                @php 
                                  $section[$key]['point'] = $groupPointActual;
                                  $section[$key]['percent'] = @round($groupPointActual/$groupPointMax * 100, 2);
                                @endphp
                            @endforeach
                            <tr>
                              <td colspan="4">Total</td>
                              <td align="center" style="vertical-align: middle;" >{{ $pointTotal }}</td>
                              <td align="center" style="vertical-align: middle;" >{{ $pointMax }}</td>
                              <td align="center" style="vertical-align: middle;" >{{ @round($pointTotal/$pointMax * 100, 2) . '%' }}</td>
                            </tr>
                            <tr style="background: #3d9970;">
                              <td colspan="4">Other comments</td>
                              <td align="center" style="vertical-align: middle;" >Section</td>
                              <td align="center" style="vertical-align: middle;" >Scores</td>
                              <td align="center" style="vertical-align: middle;" >%</td>
                            </tr>
                            @foreach($section as $k => $sec)
                              <tr>
                                @if($k == 0)
                                <td rowspan="8" colspan="4">
                                  @php $autop = new Autop($survey->feedback) @endphp
                                  {!! $autop->autoCreate() !!}
                                </td>
                                @endif
                                <td align="center" style="vertical-align: middle;" >{{ $chars[$k] }}</td>
                                <td align="center" style="vertical-align: middle;" >{{ $sec['point'] }}</td>
                                <td align="center" style="vertical-align: middle;" >{{ $sec['percent'] . '%' }}</td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

  </div>
@endsection
@push('scripts')

       
  
    <script>
       
        $(function () {
    
            $('#dataTable').DataTable({
                "responsive": true,
              "autoWidth": false,
            });
        });


    function deleteStore(Id) {
 
        document.getElementById('store-'+Id).submit()
    }


</script>
@endpush