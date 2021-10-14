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
            <h1 class="m-0 text-dark">Subject Creation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="\admin">Home</a></li>
              <li class="breadcrumb-item active">Subject Creation</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
                    <th>#</th>
                    <th>Name</th>
                    <th>Enrollment key</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody>

                  @foreach($subject as $key => $cat) 
                  @if($cat['teacher_id']==auth()->user()->uid)
                  <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $cat['subject_name'] ?></td>
                    <td><?php echo $cat['enrollment_key'] ?></td>

                    <td><input class="subject_status" data-id="<?php echo $cat['subject_name'] ?>" <?php if($cat['status']==1) { echo "checked"; }  ?> type="checkbox" name="status"></td>
                    

                    <td>
                      <a href="{{ url('admin/edit_subject/'.$cat['subject_name']) }}" class="btn btn-info">Edit</a>
                      <a href="{{ url('admin/delete_subject/'.$cat['subject_name']) }}" class="btn btn-danger">Delete</a>
                      </td>
                  </tr>
                  @endif
                  @endforeach





                 
                  </tbody>
                  <tfoot>
                    <th>#</th>
                    <th>Name</th>
                    <th>Enrollment key</th>
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
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Add New subject</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <form action=" {{ url('admin/add_new_subject') }} " method="POST"  class="database_operation">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Please enter your subject details!</h3>
               
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Subject Code</label>
                    {{ csrf_field() }}
                    <input class="form-control" name="code" required="required" type="text" placeholder="Default input">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Subject Name</label>
                    <input class="form-control  @error('subject_name') is-invalid @enderror" name="subject_name" required="required" type="text" placeholder="Name along with Year, eg: Data Analytics 2021">
                    @error('subject_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Course Name</label>
                    <input class="form-control" name="coursenm" required="required" type="text" placeholder="Default input">
                  </div>
                  <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control" name="semester">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Enrollment Key</label>
                    <input class="form-control" name="key" required="required" type="text" placeholder="Default input">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary" >Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    </form>
    </div>
  </div>
  
</div>
</div>  
  @endsection