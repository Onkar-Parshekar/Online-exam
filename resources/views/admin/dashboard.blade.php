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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- small box -->
            @foreach($teachersubj as $row)
            <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h5><?php echo $row['subject_name'] ?></h5>
                
                <p><?php echo $row['subject_code'] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="{{ url('admin/students/'.$row['subject_name']) }}" class="small-box-footer">More Info <i class="fas fa-arrow-circle-right"></i></a>
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