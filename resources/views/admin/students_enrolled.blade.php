@extends('layouts.dash')
@section('title','Students Enrolled')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Students Enrolled</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Students Enrolled</li>
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
                <h3 class="card-title">{{$sub}}</h3>

                <div class="card-tools">
                    
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <th>Sr.No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Email ID</th>
                    </thead>
                    <tbody>
                        @foreach($studentinfo as $key => $exam)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td><?php echo $exam['rollNo'] ?></td>
                            <td><?php echo $exam['Fname'] ?> <?php echo $exam['Lname'] ?></td>
                            <td><?php echo $exam['email'] ?></td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>Sr.No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Email ID</th>
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