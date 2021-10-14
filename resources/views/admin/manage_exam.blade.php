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
            <h1 class="m-0 text-dark">Manage Exams</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="\admin">Home</a></li>
              <li class="breadcrumb-item active">Manage Exams</li>
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
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal">Add New</a>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Exam Date</th>
                        <th>Duration</th>
                        <th>Marks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($exams as $key => $exam)
                          <tr>
                            <td><?php echo $exam['exam_title'] ?></td>
                            <td><?php echo $exam['subjectName'] ?></td>
                            <td><?php echo $exam['exam_date'] ?></td>
                            <td><?php echo $exam['duration'] . " min" ?></td>
                            <td><?php echo $exam['total_marks'] ?></td>
                            <td><input type="checkbox" class="exam_status" data-id="{{ $exam['id'] }}" <?php  if($exam['status']==1) { echo "checked"; } ?>
                            ></td><td>
                              <a href="{{ url('admin/update_exam/'.$exam['id']) }}" class="btn btn-info btn-sm">Edit</a>
                              <a href="{{ url('admin/delete_exam/'.$exam['id']) }}" class="btn btn-danger btn-sm">Delete</a>
                              <a href="{{ url('admin/add_question/'.$exam['id']) }}" class="btn btn-primary btn-sm">Questions</a>
                              <a href="{{ url('admin/exam_result/'.$exam['id']) }}" class="btn btn-info">Result</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Exam Date</th>
                        <th>Duration</th>
                        <th>Marks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tfoot>
                </table>
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
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add New Exam</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <!-- <form action=" {{ url('teacher/add_new_subject') }}" class="database_operation"> -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Please enter exam details!</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action=" {{ url('admin/add_new_exam') }}" method="POST" class="database_operation">
                <div class="card-body">
                  <div class="form-group">
                    {{ csrf_field() }}
                    <label>Title</label>
                        <select class="form-control" name="title">
                          <option>ISA 1</option>
                          <option>ISA 2</option>
                          <option>ISA 3</option>
                          <option>End Sem</option>
                          <option>Quiz</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Exam Date</label>
                    <input class="form-control" required="required" type="date" name="exam_date">
                  </div>
                  <div class="form-group">
                        <label>Subject Name</label>
                        <select class="form-control" name="subject_name" required="required">
                          @foreach($subject as $cat)
                            @if($cat['teacher_id']==auth()->user()->uid)
                                <option value="{{ $cat['subject_name'] }}">{{ $cat['subject_name'] }}</option>
                            @endif
                          @endforeach
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleDuration">Exam Duration</label>
                    <input class="form-control" required="required" type="text" name="exam_duration" placeholder="In minutes (eg: 90)">
                  </div>
                  <div class="form-group">
                    <label for="exampleTotalMarks">Total Marks</label>
                    <input class="form-control" required="required" type="text" name="total_marks" placeholder="Default Input">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- </form> -->
    </div>
  </div>
  
</div>
</div>	
  @endsection