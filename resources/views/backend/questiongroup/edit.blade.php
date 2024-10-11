@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1292.07px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit city</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit group</li>
              <li></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Group</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('manage.questiongroup.update', $group->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="viGroupName">Group name (Vietnamese)</label>
                    <input type="text" name="vi_group_name" class="form-control @error('vi_group_name') is-invalid @enderror" id="viGroupName" value="{{ $group->translate('vi')->title }}">
                    @error('vi_group_name')
                      <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="enGroupName">Group name (English)</label>
                    <input type="text" name="en_group_name" class="form-control @error('en_group_name') is-invalid @enderror" id="enGroupName" placeholder="Group name (English)" value="{{ $group->translate('en')->title }}">
                    @error('en_group_name')
                      <span class="error invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="{{ route('manage.questiongroup.index') }}" class="btn btn-danger mr-2">Cancel</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
