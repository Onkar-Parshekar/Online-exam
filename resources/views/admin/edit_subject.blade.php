@extends('layouts.dash')
@section('title','Dashboard')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Subject</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="\admin">Home</a></li>
              <li class="breadcrumb-item"><a href="\admin\subject_creation">subject_creation</a></li>

              
              <li class="breadcrumb-item active">Update Subject</li>
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
                                <h3 class="card-title">Please modify your subject details!</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                           
                            <form action=" {{ url('admin/edit_new_subject') }}" method="POST" class="database_operation">
                                <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Subject Code</label>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id123" value="{{ $subject->subject_name }}">
                                    <input class="form-control" value="{{ $subject->subject_code }}" required="required" type="text" placeholder="Default input" name="code">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Subject Name</label>
                                    <input class="form-control @error('subject_name') is-invalid @enderror" value="{{ $subject->subject_name }}" required="required" type="text" placeholder="Name along with Year, eg: Data Analytics 2021" name="subject_name">
                                    @error('subject_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Course Name</label>
                                    <input class="form-control" required="required" value="{{ $subject->course_name }}" type="text" placeholder="Default input" name="cname">
                                </div>
                                <div class="form-group">
                                        <label>Semester</label>
                                        <select class="form-control" name="sem" value="{{ $subject->semester }}">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Enrollment Key</label>
                                    <input class="form-control" required="required" value="{{ $subject->enrollment_key }}" type="text" placeholder="Default input" name="key">
                                </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.card -->
                    </div><!-- /.container-fluid -->
                    </section>
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
  
  @endsection