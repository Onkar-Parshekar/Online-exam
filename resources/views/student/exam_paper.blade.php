@extends('layouts.student')
@section('title','Join Exam')
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
            <h1 class="m-0 text-dark">Question Paper</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Question Paper</li>
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
                <h3 class="card-title">Best of Luck!</h3>

                <div class="card-tools">
                    <!-- <a class="btn btn-info btn-sm" href="javascript:;">Add New</a> -->
                </div>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  @foreach($marks as $tim)
                    <input type="hidden" name="exam-time" id="exam-time" value="{{$tim['duration']}}">
                    <h4>Time : {{$tim['duration']}} Min</h4>
                  @endforeach
                </div>
                <div class="col-sm-4">
                  @foreach($marks as $tim)
                    <h4 class="text-center"><span class="js-timeout" id="countdown">{{$tim['duration']}}</span></h4>
                  @endforeach
                </div>
                <div class="col-sm-4">
                  @foreach($marks as $k)
                    <h4 class="text-right">Marks : {{$k['total_marks']}}</h4>
                  @endforeach
                </div>
                </div>
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer-->
            </div>
                <!-- MCQ -->
              <form name="form1" action="{{ url('student/submit_exam') }}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="exam_id" value="{{ Request::segment(3) }}">
                  
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                        @foreach($mcq_questions as $key1 => $mcq)
                        <input type="hidden" name="mcqquest" value="<?php echo $key1+1 ?>">
                    
                            <div class="col-sm-12">
                                <p><b>#. {{ $mcq['question'] }} <span style="float:right;">{{ $mcq['marks'] }} mks</span></b></p>
                                <?php
                                    $options = json_decode(json_encode(json_decode($mcq['options'])),true);
                                ?>
                                <input type="hidden" name="mcq{{$key1+1}}" value="{{ $mcq['id'] }}">
                                <ul class="options">
                                    <li><input type="radio" value="{{ $options['option1'] }}" name="ans{{$key1+1}}"> {{ $options['option1'] }}</li>
                                    <li><input type="radio" value="{{ $options['option2'] }}" name="ans{{$key1+1}}"> {{ $options['option2'] }}</li>
                                    <li><input type="radio" value="{{ $options['option3'] }}" name="ans{{$key1+1}}"> {{ $options['option3'] }}</li>
                                    <li><input type="radio" value="{{ $options['option4'] }}" name="ans{{$key1+1}}"> {{ $options['option4'] }}</li>
                                    <li style="display:none;"><input type="radio" value="0" checked="checked" name="ans{{$key1+1}}"> {{ $options['option4'] }}</li>
                                </ul>
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
                        <input type="hidden" name="fillquest" value="<?php echo $key2+1 ?>">
                            <div class="col-sm-12">
                                <p><b>#. {{ $onefill['question'] }} <span style="float:right;">{{ $onefill['marks'] }} mks</span></b></p>
                                <input type="hidden" name="onefill{{$key2+1}}" value="{{ $onefill['id'] }}">
                                <input id="oneanswer" placeholder="Your Answer" type="text" class="form-control" name="oneanswer{{$key2+1}}">
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
                        <input type="hidden" name="truequest" value="<?php echo $key3+1 ?>">
                   
                            <div class="col-sm-12">
                                <p><b>#. {{ $tf['question'] }} <span style="float:right;">{{ $tf['marks'] }} mks</span></b></p>
                                <input type="hidden" name="tf{{$key3+1}}" value="{{ $tf['id'] }}">
                                <ul class="options">
                                    <li><input type="radio" name="answ{{$key3+1}}" value="True"> True</li>
                                    <li><input type="radio" name="answ{{$key3+1}}" value="False"> False</li>
                                    <li style="display:none;"><input type="radio" value="0" checked="checked" name="answ{{$key3+1}}"> False</li>
                                
                                </ul>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>

               
                <!-- Match the following -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                        @foreach($match_questions as $key4 => $mf)
                        <input type="hidden" name="matchquest" value="<?php echo $key4+1 ?>">
                    
                        <?php
                            $options1 = json_decode(json_encode(json_decode($mf['lhs'])),true);
                            $options2 = json_decode(json_encode(json_decode($mf['rhs'])),true);
                            shuffle($options2);
                        ?>
                            <div class="col-sm-12">
                                <p><b>#. {{ $mf['question'] }} <span style="float:right;">{{ $mf['marks'] }} mks</span></b></p>
                                <input type="hidden" name="mf{{$key4+1}}" value="{{ $mf['id'] }}">
                                <table class="table table-bordered" id="dynamic_field">  
                                  
                                @foreach(array_combine($options1,$options2) as $key => $value)
                                    <tr>  
                                      <td><label>{{$key}}</label></td>
                                      <td>
                                        <select name="{{$key}}" class="form-control">
                                          @foreach($options2 as $row)
								                            <option value="{{$row}}"> {{$row}} </option>
								                          @endforeach
							                          </select>
                                      </td>
                                    </tr>  
                                  
                                @endforeach
                                </table>
                                </ul>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="row">
                <div class="col-sm-12 mt-4">
                   
                    <button type="submit" id="formsubmit" class="btn btn-info btn-block">Submit</button>
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