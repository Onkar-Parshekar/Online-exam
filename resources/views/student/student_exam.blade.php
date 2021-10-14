
@extends('layouts.student')
@section('title','Exam Section')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exam Section</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('student/student_dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Exam Section</li>
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
                    <!-- <a class="btn btn-info btn-sm" href="javascript:;">Add New</a> -->
                </div>
              </div>
             
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <tr>
                        <th>Subject</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Duration</th>
                        
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($examans as $key => $cat)
                          <tr>
                          <td><?php echo $cat['subjectName'] ?></td>
                            <td><?php echo $cat['exam_title'] ?></td>
                            <td><?php echo $cat['exam_date'] ?></td>
                            <td><?php echo $cat['duration'] ?> min
                            </td>
                            
                            <td>
                                <?php
                                    if(strtotime($cat['exam_date'])<strtotime(date('Y-m-d')))
                                    {
                                        echo "Completed";
                                    }
                                    else if(strtotime($cat['exam_date'])==strtotime(date('Y-m-d')) && $cat['status']==1)
                                    {
                                        echo "Running";
                                    }
                                    else
                                    {
                                        echo "Pending";
                                    }
                                ?>        
                            </td>
                            <td>
                            @if(strtotime($cat['exam_date'])==strtotime(date('Y-m-d')) && $cat['status']==1 && $isanswering==0 )
                           
                              <a href="{{ url('student/join_exam/'.$cat['id']) }}" class=" exam_join btn btn-info" id="{{$cat['id']}}" id2="{{$isanswering}}"  > Join Exam</a>
                              
                            @endif

                            </td>
                          </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Result</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
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
  @endsection