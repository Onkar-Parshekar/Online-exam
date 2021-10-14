@extends('layouts.dash')
@section('title','Update Exam Question')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Exam Question</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/manage_exam') }}">Manage Exams</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('admin/add_question/'.$question[0]['exam_id']) }}">Questions</a></li>
              <li class="breadcrumb-item active">Update</li>
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

                
              </div>
              <div class="card-body">
              <form action="{{ url('admin/confirm_update_match') }}" method="POST" class="database_operation">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Question</label>
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{ $question[0]['exam_id'] }}">
            <input type="hidden" name="id" value="{{ $question[0]['id'] }}">
            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control" value="{{ $question[0]['question'] }}">
          </div>
        </div>
        @foreach($question as $key)
        <?php
            $options1 = json_decode(json_encode(json_decode($key['lhs'])),true);
            $options2 = json_decode(json_encode(json_decode($key['rhs'])),true);
        ?>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter </label>
            @foreach(array_combine($options1,$options2) as $key => $value)
            <table class="table table-bordered" id="dynamic_field">  
                  <tr>  
                      <td><input type="text" value="{{$key}}" name="lhs[]" required="required" placeholder="Enter here" class="form-control name_list" /></td>    
                      <td><input type="text" value="{{$value}}" name="rhs[]" required="required" placeholder="Enter correct answer" class="form-control name_list" /></td>  
                  </tr>  
            </table>  
            @endforeach
          </div>
        </div>
        @endforeach
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Marks</label>
            <input type="float" required="required" name="marks" placeholder="Enter Marks" class="form-control" value="{{ $question[0]['marks'] }}">
          </div>
        </div>



        
      <div class="col-sm-12">
          <div class="form-group">
            <button class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
    </form>


                
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