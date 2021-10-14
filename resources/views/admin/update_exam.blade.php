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
            <h1 class="m-0 text-dark">Update Exam</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin">Home</a></li>
              
              <li class="breadcrumb-item"><a href="\admin\manage_exam">Manage Exam</a></li>
              <li class="breadcrumb-item active">Update Exam</li>
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
                                <h3 class="card-title">Please modify exam details!</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action=" {{ url('admin/confirm_update_exam') }}" method="POST" class="database_operation">
                                <div class="card-body">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id123" value="{{ $exam->id }}">
                                    <label>Title</label>
                                        <select class="form-control" name="title">
                                        <option <?php if($exam->exam_title=="ISA 1") echo "selected";?>>ISA 1</option>
                                        <option <?php if($exam->exam_title=="ISA 2") echo "selected";?>>ISA 2</option>
                                        <option <?php if($exam->exam_title=="ISA 3") echo "selected";?>>ISA 3</option>
                                        <option <?php if($exam->exam_title=="End Sem") echo "selected";?>>End Sem</option>
                                        <option <?php if($exam->exam_title=="Quiz") echo "selected";?>>Quiz</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Exam Date</label>
                                    <input class="form-control" value="{{$exam->exam_date}}" required="required" type="date" name="exam_date">
                                </div>
                                <div class="form-group">
                                        <label>Subject Name</label>
                                        <select class="form-control" name="subject_name" required="required">
                                        @foreach($subject as $cat)
                                            @if($cat['teacher_id']==auth()->user()->uid)
                                                <option <?php if($exam->subjectName==$cat['subject_name']) echo "selected";?> value="{{ $cat['subject_name'] }}">{{ $cat['subject_name'] }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleDuration">Exam Duration</label>
                                    <input class="form-control" value="{{$exam->duration}}" required="required" type="text" name="exam_duration" placeholder="In minutes (eg: 90)">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTotalMarks">Total Marks</label>
                                    <input class="form-control" required="required" value="{{$exam->total_marks}}" type="text" name="total_marks" placeholder="Default Input">
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