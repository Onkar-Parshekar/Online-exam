@extends('layouts.dash')
@section('title','Results')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Results</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/manage_exam') }}">Manage Exams</a></li>
              <li class="breadcrumb-item active">Results</li>
              
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
                <h3 class="card-title"><?php echo $title['subjectName'] ?> <?php echo $title['exam_title'] ?></h3>

                <div class="card-tools">
                    
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <th>Sr.No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Marks Obtained</th>
                    </thead>
                    <tbody>
                        @foreach($result as $key => $exam)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ \App\studentDetails::where('PRNo', $exam['studentId'])->pluck('rollNo')[0] }}</td>
                            <td>{{ \App\studentDetails::where('PRNo', $exam['studentId'])->pluck('Fname')[0] }} {{ \App\studentDetails::where('PRNo', $exam['studentId'])->pluck('Lname')[0] }}</td>
                            <td><?php echo $exam['marks'] ?>/<?php echo $marks['total_marks'] ?></td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Sr.No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Marks Obtained</th>
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
  
</div>
</div>	
  @endsection