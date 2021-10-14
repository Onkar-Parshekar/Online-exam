@extends('layouts.dash')
@section('title','Exam Question')
@section('content')
      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exam Question</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="\admin">Home</a></li>
              <li class="breadcrumb-item"><a href="\admin\manage_exam">Manage Exams</a></li>
              <li class="breadcrumb-item active">Exam Question</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- calculating total -->
    <input type="hidden" name="total_marks1" value="{{$total1=0}}">
    <div hidden>
    @foreach($match_questions as $key => $question)
    @if ($question['status']==1)
      {{$total1=$total1+$question['marks']}}
    @endif
    @endforeach  

    @foreach($mcq_questions as $key => $question)
      @if ($question['status']==1)
     {{ $total1=$total1+$question['marks']}}
    @endif
    @endforeach

    @foreach($oneword_questions as $key => $question)
      @if ($question['status']==1)
    {{  $total1=$total1+$question['marks']}}
    @endif
    @endforeach

    @foreach($TF_questions as $key => $question)
      @if ($question['status']==1)
     {{ $total1=$total1+$question['marks']}}
    @endif
    @endforeach

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
                
                
                  <a class="btn btn-info btn-sm " href="javascript:;" data-toggle="modal" data-target="#myModal">MCQ</a>
              
                  <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal_fill_in_blanks">Fill in the blank</a>
                  

                  <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal_true_or_false">True/False</a>
                  
                  
                  <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal_match">Match</a>
              
              
                    
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered table-hover datatable">
                    <thead>
                    <th>#</th>
	                    <th>Question</th>
	                    <th>Ans</th>
                      <th>Type</th>
                      <th>Marks</th>
	                    <th>Status</th>
	                    <th>Action</th>
                    </thead>
                    <tbody>
                    <!-- mcq questions -->
                   
                    
                    @foreach($mcq_questions as $key => $question)
                    
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $question['question'] }}</td>
                    <td>{{ $question['answer'] }}</td>
                    <td>{{ $question['question_type'] }}</td>
                    <td>{{ $question['marks'] }}</td>

                     <td><input class="question_status"  m1="{{ $question['marks'] }}" data-id="{{ $question['id'] }}" total_m="{{$total1}}" total_e="{{$total_marks}}" data-type="{{$question['question_type']}}" <?php if($question['status']==1) {  echo 'checked flag="1" '; } else { echo 'flag="0"'; }?> type="checkbox" name="status"></td>
                    <td>
                      <a href="{{ url('admin/delete_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-danger btn-sm">Delete</a>
                      <a href="{{ url('admin/update_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-info btn-sm">Update</a>
                    </td>
                  </tr>
                  @endforeach  
                    <!--end of mcq  -->

                  <!-- one word questions -->
                  
                  @foreach($oneword_questions as $key => $question)
                  
                  <tr>
                   
                    <td>{{ $key+1 }}</td>
                    <td>{{ $question['question'] }}</td>
                    <td>{{ $question['answer'] }}</td>
                    <td>{{ $question['question_type'] }}</td>
                    <td>{{ $question['marks'] }}</td>
                    <td><input class="question_status"  m1="{{ $question['marks'] }}" data-id="{{ $question['id'] }}" total_m="{{$total1}}" total_e="{{$total_marks}}" data-type="{{$question['question_type']}}" <?php if($question['status']==1) {  echo 'checked flag="1" '; } else { echo 'flag="0"'; }?> type="checkbox" name="status"></td>
                   <td>
                      <a href="{{ url('admin/delete_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-danger btn-sm">Delete</a>
                      <a href="{{ url('admin/update_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-info btn-sm">Update</a>
                    </td>
                  </tr>
                  @endforeach  
                    <!--end of one word  -->


                  <!-- True false -->
                  @foreach($TF_questions as $key => $question)
                    
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $question['question'] }}</td>
                    <td>{{ $question['answer'] }}</td>
                    <td>{{ $question['question_type'] }}</td>
                    <td>{{ $question['marks'] }}</td>

                    <td><input class="question_status" m1="{{ $question['marks'] }}" data-id="{{ $question['id'] }}" total_e="{{$total_marks}}" total_m="{{$total1}}" data-type="{{$question['question_type']}}" <?php if($question['status']==1) {  echo 'checked flag="1" '; } else { echo 'flag="0"'; }?> type="checkbox" name="status"></td>
                    <td>
                      <a href="{{ url('admin/delete_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-danger btn-sm">Delete</a>
                      <a href="{{ url('admin/update_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-info btn-sm">Update</a>
                    </td>
                  </tr>
                  @endforeach

                   <!-- match the following questions -->
                  
                   @foreach($match_questions as $key => $question)
                  <tr>
                  <?php
                      $options1 = json_decode(json_encode(json_decode($question['lhs'])),true);
                      $options2 = json_decode(json_encode(json_decode($question['rhs'])),true);
                  ?>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $question['question'] }}</td>
                    <td>
                      @foreach(array_combine($options1,$options2) as $key2 => $value)
                        {{$key2}} : {{$value}} <br>
                      @endforeach
                    </td>
                    <td>{{ $question['question_type'] }}</td>
                    <td>{{ $question['marks'] }}</td>
                    <td><input class="question_status" m1="{{ $question['marks'] }}" data-id="{{ $question['id'] }}" total_e="{{$total_marks}}" data-type="{{$question['question_type']}}" total_m="{{$total1}}"<?php if($question['status']==1) {  echo 'checked flag="1" '; } else { echo 'flag="0"'; }?> type="checkbox" name="status"></td>
                    <td>
                      <a href="{{ url('admin/delete_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-danger btn-sm">Delete</a>
                      <a href="{{ url('admin/update_question/'.$question['id'].'/'.$question['question_type']) }}" class="btn btn-info btn-sm">Update</a>
                    </td>
                  </tr>
                  @endforeach  
                    <!--end of match the following  -->

                   


                    </tbody>
                    <tfoot>
                    <th>#</th>
	                    <th>Question</th>
	                    <th>Ans</th>
                      <th>Type</th>
                      <th>Marks = {{$total1}}</th>
	                    <th>Status </th>
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
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
    @if($total1 < $total_marks)
      <h4 class="modal-title">Add New Question</h4>
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
                <h3 class="card-title">Please enter Question!</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/add_new_question') }}" method="POST" class="database_operation">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Question</label>
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{ Request::segment(3) }}">
            <input type="hidden" name="question_type" value="mcq">
            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Enter Option 1</label>
            <input type="text" required="required" name="option1" placeholder="Enter Option 1" class="form-control">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Enter Option 2</label>
            <input type="text" required="required" name="option2" placeholder="Enter Option 2" class="form-control">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Enter Option 3</label>
            <input type="text" required="required" name="option3" placeholder="Enter Option 3" class="form-control">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Enter Option 4</label>
            <input type="text" required="required" name="option4" placeholder="Enter Option 4" class="form-control">
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Corrrect Answer</label>
            <input type="text" required="required" name="ans" placeholder="Enter Right Ans" class="form-control">
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Marks</label>
            <input type="float" required="required" name="marks" placeholder="Enter Marks" class="form-control">
          
          </div>
        </div>





        <div class="col-sm-12">
          <div class="form-group">
            <button class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>
    </form>
    @else
    <h4 class="modal-title">Error</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="btn-danger">
            
              <div class="card-header">
                <h3 class="card-title ">Total Marks crossed {{$total_marks}}!!!!</h3>
              </div>
    
    @endif
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- </form> -->
    </div>
  </div>
  
</div>
</div>	



<!-- new question modal for fill in blanks -->
<div class="modal fade" id="myModal_fill_in_blanks" role="dialog">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
    @if($total1 < $total_marks)
      <h4 class="modal-title">Add New Question</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
            
              <div class="card-header">
                <h3 class="card-title">Please enter Question!</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/add_new_question') }}" method="POST" class="database_operation">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Question</label>
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{ Request::segment(3) }}">
            <input type="hidden" name="question_type" value="oneword">
            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control">
          </div>
        </div>
        
        
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Correct Answer</label>
            <input type="text" required="required" name="ans" placeholder="Enter Right Ans" class="form-control">
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Marks</label>
            <input type="float" required="required" name="marks" placeholder="Enter Marks" class="form-control" >
          </div>
        </div>




        <div class="col-sm-12">
          <div class="form-group">
            <button class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>
    </form>
    @else
    <h4 class="modal-title">Error</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="btn-danger">
            
              <div class="card-header">
                <h3 class="card-title ">Total Marks crossed {{$total_marks}}!!!!</h3>
              </div>
    
    
    
    
    @endif
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- </form> -->
    </div>
  </div>
  
</div>
</div>	
 <!--end of modal  -->


<!-- question modal for true and false -->
 <div class="modal fade" id="myModal_true_or_false" role="dialog">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
    @if($total1 < $total_marks)
      <h4 class="modal-title">Add New Question</h4>
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
                <h3 class="card-title">Please enter Question!</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/add_new_question') }}" method="POST" class="database_operation">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Question</label>
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{ Request::segment(3) }}">
            <input type="hidden" name="question_type" value="TrueFalse">
            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control">
          </div>
        </div>
        
        
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Correct Answer</label>
            <select name="ans" id="ans" class="form-control">
              <option value="True">True</option>
              <option value="False">False</option>
            </select>
          
          
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Marks</label>
            <input type="float" required="required" name="marks" placeholder="Enter Marks" class="form-control" >
          </div>
        </div>




        <div class="col-sm-12">
          <div class="form-group">
            <button class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>
    </form>
    
    @else
    <h4 class="modal-title">Error</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="btn-danger">
            
              <div class="card-header">
                <h3 class="card-title ">Total Marks crossed {{$total_marks}}!!!!</h3>
              </div>
    
    
    @endif
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- </form> -->
    </div>
  </div>
  
</div>
</div>	
 <!--end of modal  -->




<!-- question modal for match the following -->
<div class="modal fade" id="myModal_match" role="dialog">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
    @if($total1 < $total_marks)
      <h4 class="modal-title">Add New Question</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
            
              <div class="card-header">
                <h3 class="card-title">Please enter Question!</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('admin/add_new_question') }}" method="POST" class="database_operation">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Question</label>
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{ Request::segment(3) }}">
            <input type="hidden" name="question_type" value="match">
            <input type="text" required="required" name="question" placeholder="Enter Question" class="form-control">
          </div>
        </div>
        
        
        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter </label>
            <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                         <td><input type="text" name="lhs[]" placeholder="Enter here" class="form-control name_list" /></td>  
                                         <td><input type="text" name="rhs[]" placeholder="Enter correct answer" class="form-control name_list" /></td>  
                                         
                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                    </tr>  
            </table>  
          
          
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            <label>Enter Marks</label>
            <input type="float" required="required" name="marks" placeholder="Enter Marks" class="form-control" >
          </div>
        </div>




        <div class="col-sm-12">
          <div class="form-group">
            <button class="btn btn-primary">Add</button>
          </div>
        </div>
      </div>
    </form>
    
    @else
    <h4 class="modal-title">Error</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="btn-danger">
            
              <div class="card-header">
                <h3 class="card-title ">Total Marks crossed {{$total_marks}}!!!!</h3>
              </div>
    
    
    @endif
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- </form> -->
    </div>
  </div>
  
</div>
</div>	
 <!--end of modal  -->
 




@endsection