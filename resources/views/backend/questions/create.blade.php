@extends('layouts.app')

@push('styles')
<style>
ul.list_answer{
  list-style-type: none;
  padding: 0;
  margin-bottom: 30px
}
ul.list_answer li{
  border: 1px solid #f1f1f1;
  padding: 10px
}
ul.list_answer li p{
  margin: 0
}
div.content{
  display: flex;
    align-items: center;
    justify-content: space-between;
}
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-sm-6">
            <h1>Questions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('manage.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('manage.questionnaire.index') }}">Questionnairs</a></li>
              <li class="breadcrumb-item active">Questions</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('manage.questions.store', $questionnaire->id) }}">
                            @csrf
                            <div class="card-body">
                              <div class="form-group">
                                <label for="vi_title">{{ __('Question title (VI)') }}</label>
                                <input type="text" class="form-control @error('vi_title') is-invalid @enderror" value="{{ old('vi_title') }}" id="vi_title" name="vi_title" placeholder="Questionnaire title">
                                @error('vi_title')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="form-group">
                                <label for="title">{{ __('Question title (EN)') }}</label>
                                <input type="text" class="form-control @error('en_title') is-invalid @enderror" value="{{ old('en_title') }}" id="en_title" name="en_title" placeholder="Questionnaire title">
                                @error('en_title')
                                    <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                              </div>
                              <hr>

                              <!--- group--->
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-12">
                                    <h4>Select Group</h4>
                                    <p>
                                      <small>Choose group for this question</small>
                                    <p>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                      <label>Group</label>
                                      <select class="form-control select2bs4 @error('group_question') is-invalid @enderror" style="width: 100%;" name="group_question">
                                        <option value="">Choose Group</option>
                                        @foreach($groups as $group)
                                          <option value="{{ $group->id }}" {{ old('group_question') ==  $group->id ? 'selected' : ''}}>{{ $group->translate('en')->title }}</option>
                                        @endforeach
                                      </select>
                                      @error('group_question')
                                          <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr>
                              <!--question type-->
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-12">
                                    <h4>Answer type</h4>
                                    <p>
                                      <small>Choose the type of answer for the question</small>
                                    <p>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-4">
                                    <div class="custom-control custom-radio">
                                      <input class="custom-control-input" v-model="answerType" type="radio" id="answer_yn" value="yn">
                                      <label for="answer_yn" class="custom-control-label">Yes/No</label>
                                    </div>
                                  </div>
                                  <div class="col-4">
                                    <div class="custom-control custom-radio">
                                      <input class="custom-control-input" v-model="answerType" type="radio" id="answer_choice" value="choice">
                                      <label for="answer_choice" class="custom-control-label">Choice</label>
                                    </div>
                                  </div>
                                  <div class="col-4">
                                    <div class="custom-control custom-radio">
                                      <input class="custom-control-input" v-model="answerType" type="radio" id="answer_other" value="other">
                                      <label for="answer_other" class="custom-control-label">Other</label>
                                    </div>
                                  </div>
                                  <input type="hidden" name="answer_type" :value="answerType" />
                                </div>
                              </div>
                              <hr>
                              <!---answer------>
                              <div id="answers">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="answer_yn_type" v-if="answerType == 'yn'">
                                        <h4>Yes/no answer</h4>
                                        <p>The answer type automatic add 2 answer for this question. just config point for each answer below</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Point for yes answer (min-max: 0-10 point)</label>
                                                    <input type="number" class="form-control @error('answers.point.yes') is-invalid @enderror" min="0" max="10" value="{{ old('answers.point.yes') }}" name="answers[point][yes]">
                                                    @error('answers.point.yes')
                                                        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                  </div>
                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="show_form_yes" name="answers[show_form][yes]">
                                                    <label for="show_form_yes">Show Detail form</label>
                                                  </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Point for no answer (min-max: 0-10 point)</label>
                                                    <input type="number" class="form-control @error('answers.point.no') is-invalid @enderror" value="{{ old('answers.point.no') }}" min="0" max="10" name="answers[point][no]">
                                                    @error('answers.point.no')
                                                      <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                                                  @enderror
                                                  </div>
                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="show_form_no" name="answers[show_form][no]">
                                                    <label for="show_form_no">Show Detail form</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--yes/no type-->

                                    <div class="answer_choice_type" v-if="answerType == 'choice'">
                                      <h4>Choice</h4>
                                      <p>Add the answer choice and point for each choice</p>
                                      <div class="card">
                                        <div class="card-body">
                                          {{-- <div class="row" class="choice choice_1">
                                            <div class="col-12 col-md-4 col-lg-5">
                                              <div class="form-group">
                                                <input type="text" v-model="newAnswerVi" class="form-control mb-2" placeholder="Answer (VI)">
                                                <input type="text" v-model="newAnswerEn" class="form-control mb-2" placeholder="Answer (EN)">
                                              </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-5">
                                              <div class="form-group">
                                                <input type="number" v-model="newPoint" class="form-control" placeholder="Point for answer  (min-max: 0-10 point)">
                                              </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-2">
                                              <button class="btn btn-info btn-block" type="button" @click="addAnswer()">Add more answer</button>
                                            </div>
                                          </div> --}}
                                          <div class="wrap__choice">
                                            <h4>Answer 1</h4>
                                            <div class="row" class="answer answer_1">
                                              <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                  <input type="text" name="answers[0][answer][vi]" class="form-control mb-2" placeholder="Answer (VI)">
                                                  <input type="text"  name="answers[0][answer][en]" class="form-control mb-2" placeholder="Answer (EN)">
                                                </div>
                                              </div>
                                              <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                  <input type="number" name="answers[0][point]" class="form-control" placeholder="Point for answer  (min-max: 0-10 point)">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                  <div class="icheck-primary">
                                                      <input type="checkbox" id="show_form_choice_1" name="answers[0][show_form]">
                                                      <label for="show_form_choice_1">Show Detail form</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="wrap__choice">
                                            <h4>Answer 2</h4>
                                            <div class="row" class="answer answer_2">
                                              <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                  <input type="text" name="answers[1][answer][vi]" class="form-control mb-2" placeholder="Answer (VI)">
                                                  <input type="text"  name="answers[1][answer][en]" class="form-control mb-2" placeholder="Answer (EN)">
                                                </div>
                                              </div>
                                              <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                  <input type="number" name="answers[1][point]" class="form-control" placeholder="Point for answer  (min-max: 0-10 point)">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                  <div class="icheck-primary">
                                                      <input type="checkbox" id="show_form_choice_2" name="answers[1][show_form]">
                                                      <label for="show_form_choice_2">Show Detail form</label>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="wrap__choice">
                                            <h4>Answer 3</h4>
                                            <div class="row" class="answer answer_3">
                                              <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                  <input type="text" name="answers[2][answer][vi]" class="form-control mb-2" placeholder="Answer (VI)">
                                                  <input type="text"  name="answers[2][answer][en]" class="form-control mb-2" placeholder="Answer (EN)">
                                                </div>
                                              </div>
                                              <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                  <input type="number" name="answers[2][point]" class="form-control" placeholder="Point for answer  (min-max: 0-10 point)">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                  <div class="icheck-primary">
                                                      <input type="checkbox" id="show_form_choice_3" name="answers[2][show_form]">
                                                      <label for="show_form_choice_3">Show Detail form</label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <ul class="list_answer">   
                                            {{-- <answer
                                              v-for="(answer, index) in answers"
                                              :key="answer.id"
                                              :answer="answer"
                                              :index="index"
                                            ></answer> --}}
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <!--choice type-->
                                    <div class="answer_other_type" v-if="answerType == 'other'">
                                    
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary">create question</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
        
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  </div>
@endsection

@push('scripts')
    <script>
      const app = new Vue({
        el: '#app',
        data: {

          answerType: 'yn',
          newAnswerVi: '',
          newAnswerEn: '',
          newPoint: '',
          answers: [],
        }, 
        methods: {
          addAnswer(){
            if (this.newAnswer == '' || this.newPoint == ''){
              return
            }
            this.answers.push({
                  id: this.id,
                  answer: {
                    vi: this.newAnswerVi,
                    en: this.newAnswerEn
                  },
                  point: this.newPoint
            })
            this.newAnswerVi = '';
            this.newAnswerEn = '';
            this.newPoint = '';
            this.id++;
          },
          removeAnswer(index){

          }
        }
      })
    </script>   
@endpush