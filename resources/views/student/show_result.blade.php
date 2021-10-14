@extends('layouts.student')
@section('title','Exam Result')
@section('content')
<style type="text/css">
    .options>li {
        list-style: none;
        height: 50px;
        line-height: 50px;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Exam Result</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('student/student_dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('student/exam') }}">Exam Section</a></li>
              <li class="breadcrumb-item active">Exam Result</li>
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
                <h3 class="card-title">Better Luck Next Time!</h3>
                

                <div class="card-tools">
                    <!-- <a class="btn btn-info btn-sm" href="javascript:;">Add New</a> -->
                </div>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  @foreach($examdetails as $tim)
                    <h4>Title : {{$tim['exam_title']}}</h4>
                  @endforeach
                </div>
               
                <div class="col-sm-4">
                  @foreach($examdetails as $k)
                    <h4 class="text-right">Marks Obained : {{$title}} / {{$k['total_marks']}}</h4>
                  @endforeach
                </div>
                </div>
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer-->
            </div>
                <!-- MCQ -->
              <form name="form1" action="{{ url('student/exam') }}" >
              {{ csrf_field() }}
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                        @foreach($mcq_questions as $key1 => $mcq)
                            <div class="col-sm-12">
                                <p><b>#. {{ $mcq['question'] }} <span style="float:right;">{{ $mcq['marks'] }} mks</span></b></p>
                                <p>Expected Answer : {{$mcq['answer']}}</p>
                                @if ($mcq['answer']==$answers['ans'.($key1+1)])
                                <p class="bg-success text-white">Your Answer : {{$answers['ans'.($key1+1)]}} <b><span style="float:right;">{{ round($mcq['marks'],2) }} mks</span></b></p>
                                <p></p>
                                @else
                                <p class="bg-danger text-white">Your Answer : {{$answers['ans'.($key1+1)]}} <b><span style="float:right;">0 mks</span></b></p>
                                @endif
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <!-- Fill in the blanks -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                        @foreach($onefill_questions as $key2 => $onefill)
                            <div class="col-sm-12">
                                <p><b>#. {{ $onefill['question'] }} <span style="float:right;">{{ $onefill['marks'] }} mks</span></b></p>
                                <p>Expected Answer : {{$onefill['answer']}}</p>
                                @if (strcasecmp($onefill['answer'],$answers['oneanswer'.($key2+1)])==0)
                                <p class="bg-success text-white">Your Answer : {{$answers['oneanswer'.($key2+1)]}} <b><span style="float:right;">{{ round($onefill['marks'],2) }} mks</span></b></p>
                                @else
                                <p class="bg-danger text-white">Your Answer : {{$answers['oneanswer'.($key2+1)]}} <b><span style="float:right;">0 mks</span></b></p>
                                @endif
                            </div>
                        
                        @endforeach
                    </div>
                </div>
                </div>
                <!-- True or False -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                        @foreach($truefalse_questions as $key3 => $tf)
                            <div class="col-sm-12">
                                <p><b>#. {{ $tf['question'] }} <span style="float:right;">{{ $tf['marks'] }} mks</span></b></p>
                                <p>Expected Answer : {{$tf['answer']}}</p>
                                @if($tf['answer']==$answers['answ'.($key3+1)])
                                <p class="bg-success text-white">Your Answer : {{$answers['answ'.($key3+1)]}} <b><span style="float:right;">{{ round($tf['marks'],2) }} mks</span></b></p>
                                @else
                                <p class="bg-danger text-white">Your Answer : {{$answers['answ'.($key3+1)]}}  <b><span style="float:right;">0 mks</span></b> </p>
                                @endif
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <!-- Match the following -->
                <!-- Match the following -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                        @foreach($match_questions as $key4 => $mf)
                            <div class="col-sm-12">
                                <p><b>#. {{ $mf['question'] }} <span style="float:right;">{{ $mf['marks'] }} mks</span></b></p>
                                <?php
                                    $options1 = json_decode(json_encode(json_decode($mf['lhs'])),true);
                                    $options2 = json_decode(json_encode(json_decode($mf['rhs'])),true);
                                ?>
                                
                                
                                <input type="hidden" value="{{$i=0}}" name="total">
                                <input type="hidden" value="{{$j=0}}" name="total">
                                @foreach(array_combine($options1,$options2) as $key => $value)
                                <input type="hidden" value="{{$i=$i+1}}" name="total">
                                @endforeach
                                <!-- new table -->
                                <table class="table table-bordered" id="dynamic_field">  
                                  <tr><th>Column1</th><th>Expected Answer</th><th>Your Answer</th></tr>
                                
                                @foreach(array_combine($options1,$options2) as $key => $value)
                                    <tr>  
                                    
                                      <td><label>{{$key}}</label></td>
                                      <td>
                                      {{$value}}
                                      </td>
                                      @if($value==$answers[''.$key])
                                      <td class="bg-success text-white">{{$answers[''.$key]}}</td>
                                      <input type="hidden" value="{{$j=$j+1}}" name="total1">
                                      @else
                                      <td class="bg-danger text-white">{{$answers[''.$key]}}</td>
                                      
                                      @endif
                                    </tr>  
                                
                                @endforeach
                                <tr><th>Marks</th><th></th><th>{{round(($mf['marks']/$i)*$j,2)}}</th></tr>
                                
                                </table>

                                <!-- end table -->







                                
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-12 mt-4">
                    <button type="submit" id="formsubmit" class="btn btn-info btn-block">Next</button>
                </div>
                </div>
            <!-- /.card -->
              </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection