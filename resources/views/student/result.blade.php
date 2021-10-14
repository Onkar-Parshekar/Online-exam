@extends('layouts.student')
@section('title','Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Results</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('student/student_dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Result</li>
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
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <tr>
                        <th>Sr no</th>
                        <th>Subject</th>
                        <th>Title</th>
                        <th>Marks</th>
                        
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($res as $key => $cat)
                          <tr>
                          <td>{{$key+1}}</td>
                            
                            <td><?php echo $cat['subjectName'] ?></td>
                            <td><?php echo $cat['exam_title'] ?></td>
                            <td><?php echo $cat['marks'].'/'.$cat['total_marks']?></td>
                            </tr>
                    @endforeach
                    
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Sr no</th>
                        <th>Subject</th>
                        <th>Title</th>
                        <th>Marks</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
           

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