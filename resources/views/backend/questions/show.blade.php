@extends('layouts.app')


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
              <li class="breadcrumb-item"><a href="{{ route('manage.questionnaire.index') }}">Questionnaires</a></li>
              <li class="breadcrumb-item active">Question</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                      <div class="col-12 mb-2 mt-2 mb-3">
                        <h2>{{ $question->translate('en')->question }}</h2>
                      </div>
                      <div class="col-12">
                        <div class="card">
                        
                          <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                      <tr>
                                        <th style="width: 35%">Answer (VI)</th>
                                        <th style="width: 35%">Answer (EN)</th>
                                        <th style="width: 10%">Point</th>
                                        <th>Actions</th>
                                      </tr>
                                </thead>
                                <tbody>
                                  
                                    @foreach($answers as $key => $answer)
                                      <tr>
                                       
                                          <td>{{ $answer->translate('vi')->answer }}</td>
                                          <td>{{ $answer->translate('en')->answer }}</td>
                                          <td>{{ $answer->point }}</td>
                                        <td>
                                            <a class="btn btn-info" href="">{{ __('Edit') }}</a>
                                          </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                         
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('manage.questions.index', $questionnaire->id) }}" class="btn btn-danger">Back</a>
                    </div>
                    </div>
                </div>
            </div>
        
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  </div>
@endsection
