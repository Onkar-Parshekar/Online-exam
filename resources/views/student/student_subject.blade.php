@extends('layouts.student')
@section('title','My Subjects')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Subjects</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('student/student_dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">My Subjects</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- small box -->
            @foreach($display_subject as $row)
            <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h5><?php echo $row['subjectName'] ?></h5>
                
                <p><?php echo $row['subject_code'] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-university"></i>
              </div>
            </div>
            </div>
            @endforeach

          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection