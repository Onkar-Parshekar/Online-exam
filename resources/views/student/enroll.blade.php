@extends('layouts.student')
@section('title','Enroll')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Enroll</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Enroll</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
            <div class="card-header">
                                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                            <div class="card-header">
                            @if(session()->has('error'))
                              <div class="alert alert-danger">
                                {{ session()->get('error') }}
                              </div>  
                            @endif  
                              <h3 class="card-title">Please enter enrollment key</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('student/verify_enroll') }}" method="POST" class="database_operation">
                            <div class="card-body">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id123" value="{{ $subj->subject_name }}">
                                    <label>Subject : <?php echo $subj['subject_name'] ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Subject Code : <?php echo $subj['subject_code'] ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Semester : <?php echo $subj['semester'] ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="exampleDuration">Enrollment Key</label>
                                    <input id="enrollkey" class="form-control @error('enrollkey') is-invalid @enderror" required="required" type="text" name="enrollkey" placeholder="Default Input">
                                    @error('enrollkey')
                                      <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enroll</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.card -->
                    </div><!-- /.container-fluid -->
                    </section>
              </div>
              <div class="card-body">
                
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Modal -->
  @endsection