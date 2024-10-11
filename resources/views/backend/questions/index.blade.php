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
              <li class="breadcrumb-item active">Questions</li>
            </ol>
          </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                      <div class="col-12 mb-2 mt-2 mb-3">
                        <h2>{{ $questionnaire->translate('en')->title }}</h2>
                      </div>
                      <div class="col-12 mb-2 mt-2 mb-3">
                        <p><small>{!! $questionnaire->translate('en')->description !!}</small></p>
                      </div>
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                      <tr>
                                          <th style="width: 5%">
                                              #
                                          </th>
                                        <th style="width: 70%">Question</th>
                                        <th>Actions</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $key => $question)
                                      <tr>
                                          <td>{{ $key + 1 }}</td>
                                          <td>{{ $question->translate('en')->question }}</td>
                                        <td>
                                            <a class="btn btn-success mr-2" href="{{ route('manage.questions.show', [$questionnaire->id, $question->id]) }}">{{ __('view question') }}</a>
                                            <a class="btn btn-info" href="{{ route('manage.questions.edit', [$questionnaire->id, $question->id]) }}">{{ __('Edit') }}</a>
                                          </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <div class="card-footer mt-5">
                          <a href="{{ route('manage.questions.create', $questionnaire->id) }}" class="btn btn-success">Add more questions</a>
                        </div>
                        <!-- /.card -->
                      </div>
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
