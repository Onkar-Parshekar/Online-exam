<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\exam_question_master;
use App\OneWord;
use App\TrueFalse;
use App\MatchFollowing;
use App\exam_creates;
use Illuminate\Support\Facades\Validator;

class QuestionPaper extends Controller
{
    
  public function add_question($exam_id){
    //echo $exam_id;
    //mcq table
    $exam = exam_creates::where('id',$exam_id)->get()->first();
    $data['total_marks']=$exam->total_marks;

    $data['mcq_questions']=exam_question_master::where('exam_id',$exam_id)->get()->toArray();

    //one word table
    $data['oneword_questions']=OneWord::where('exam_id',$exam_id)->get()->toArray();

    //True false
    $data['TF_questions']=TrueFalse::where('exam_id',$exam_id)->get()->toArray();

    //match the columns
    $data['match_questions']=MatchFollowing::where('exam_id',$exam_id)->get()->toArray();
    


    return view('admin.add_question',$data);
  }

  public function add_new_question(Request $request){


    if($request->question_type=="mcq"){

      
    $validator=Validator::make($request->all(),
    ['question'=>'required','option1'=>'required','option2'=>'required',
    'option3'=>'required','option4'=>'required',
    'ans'=>'required','marks'=>'required'
    ]);
		if($validator->passes())
		{
			$question = new exam_question_master();
			$question->exam_id=$request->exam_id;
			$question->question=$request->question;
			$question->answer=$request->ans;
			$question->status=0;
      $question->marks=$request->marks;
      $question->question_type=$request->question_type;
			$question->options=json_encode(array('option1'=>$request->option1,'option2'=>$request->option2,'option3'=>$request->option3,'option4'=>$request->option4));
			$question->save();
		//	$arr=array('status'=>'true','message'=>'Question Successfully Added','reload'=>url('admin/add_question/'.$request->exam_id));
      return redirect('admin/add_question/'.$request->exam_id)->with('status',"Exam details updated successfully");
    
    }
		else 
		{
			//$arr=array('status'=>'false','message'=>$validator->errors()->all());
      return redirect()->back()
      ->withInput()
      ->withErrors($validator);
		}

      }
      else if($request->question_type=="TrueFalse"){
        $validator=Validator::make($request->all(),['question'=>'required','ans'=>'required']);
		if($validator->passes())
		{
			$question = new TrueFalse();
			$question->exam_id=$request->exam_id;
			$question->question=$request->question;
			$question->answer=$request->ans;
      $question->marks=$request->marks;
			$question->status=0;
      $question->question_type=$request->question_type;
			$question->save();
		 return redirect('admin/add_question/'.$request->exam_id)->with('status',"Exam details updated successfully");
    
    }
		else 
		{
			//$arr=array('status'=>'false','message'=>$validator->errors()->all());
            return redirect()->back()
            ->withInput()
            ->withErrors($validator);
		}


      }
      else if($request->question_type=="oneword"){
        $validator=Validator::make($request->all(),['question'=>'required',
        'ans'=>'required','marks'=>'required']);
		if($validator->passes())
		{
			$question = new OneWord();
			$question->exam_id=$request->exam_id;
			$question->question=$request->question;
			$question->answer=$request->ans;
      $question->marks=$request->marks;
			$question->status=0;
            $question->question_type=$request->question_type;
			$question->save();
		 return redirect('admin/add_question/'.$request->exam_id)->with('status',"Exam details updated successfully");
    
    }
		else 
		{
			//$arr=array('status'=>'false','message'=>$validator->errors()->all());
            return redirect()->back()
            ->withInput()
            ->withErrors($validator);
		}


      }

      else {
        $validator = Validator::make($request->all(),[
            "lhs.*" => "required",
            "rhs.*" => "required",
            'question'=>'required',
            'marks'=>'required'
        ]);
        if($validator->passes())
        {
          $question = new MatchFollowing();
          $question->exam_id=$request->exam_id;
          $question->question=$request->question;
          $i=0;
          $lhs_array=array();
          $rhs_array=array();
          foreach($request->lhs as $a){
            array_push($lhs_array,$a);
          }
          foreach($request->rhs as $a){
            array_push($rhs_array,$a);
          }
          $question->lhs=json_encode($lhs_array);
          $question->rhs=json_encode($rhs_array);
          $question->marks=$request->marks;
          $question->status=0;
          $question->question_type=$request->question_type;
          $question->save();
          return redirect('admin/add_question/'.$request->exam_id)->with('status',"Exam details updated successfully");
        }
        else
        {
          return redirect()->back()
          ->withInput()
          ->withErrors($validator);
        }
    }






		
  }


  public function question_status($id,$type){
      if($type=="mcq"){
        $stat1=exam_question_master::where('id',$id)->get()->first();
        // $stat2=exam_question_master::where('id',$id)->get()->first();
      }
        
      else if($type=="oneword"){
        $stat1=OneWord::where('id',$id)->get()->first();
        // $stat2=OneWord::where('id',$id)->get()->first();

      }
      elseif($type=="TrueFalse"){
        $stat1=TrueFalse::where('id',$id)->get()->first();

      }
      else {
        $stat1=MatchFollowing::where('id',$id)->get()->first();
      }
        
	if($stat1->status==1){
        $status=0;
    }
	else {
   
      $status=1;

  }
	$stat1->status=$status;
  $exam_id=$stat1->exam_id;
	$stat1->update();

  $cat1 =exam_creates::where('id',$exam_id)->get()->first();
  $cat1->status=0;
  $cat1->update();

  //return view('admin.add_question'.$exam_id);
  //return redirect('admin/add_question/'.$exam_id);
  }

  public function delete_question($id,$type){
      if($type=="mcq")
        {$question = exam_question_master::where('id',$id)->get()->first();}
     elseif($type=="oneword"){
      $question = OneWord::where('id',$id)->get()->first();
     }
     elseif($type=="TrueFalse"){
      $question = TrueFalse::where('id',$id)->get()->first();
     }
     else {
      $question=MatchFollowing::where('id',$id)->get()->first();
    }
     
    $exam_id=$question->exam_id;
    
    $question->delete();
    $cat1 =exam_creates::where('id',$exam_id)->get()->first();
  $cat1->status=0;
  $cat1->update();
    return redirect(url('admin/add_question/'.$exam_id));
   }

   public function update_question($id,$type)
	{
    
      switch($type){
        case "mcq":
          $data['question']=exam_question_master::where('id',$id)->get()->toArray();
          return view('admin.update_question',$data);
          
        case "oneword":
          $data['question']=OneWord::where('id',$id)->get()->toArray();
          return view('admin.update_oneword',$data);

        case "TrueFalse":
          $data['question']=TrueFalse::where('id',$id)->get()->toArray();
          return view('admin.update_TrueFalse',$data);

        case "match":
          $data['question']=MatchFollowing::where('id',$id)->get()->toArray();
          return view('admin.update_match',$data);
        
      }
     
	}

  public function confirm_update_question(Request $request)
  {
      $question =exam_question_master::where('id',$request->id)->get()->first();
      $rules = [
          'question' => 'required',
          'option1'=>'required',
          'option2'=>'required',
          'option3'=>'required',
          'option4'=>'required',
          'ans'=>'required',
          'marks'=>'required',
         
      ];
      $validator = Validator::make($request->all(),$rules);
  if ($validator->fails()) {
          return redirect()->back()
          ->withInput()
          ->withErrors($validator);
  } else {
          $question->question=$request->question;
          $question->answer=$request->ans;
          $question->marks=$request->marks;
          $question->status=0;
          $question->options=json_encode(array('option1'=>$request->option1,'option2'=>$request->option2,
          'option3'=>$request->option3,'option4'=>$request->option4));
          $question->update();
          return redirect('admin/add_question/'.$question->exam_id)->with('status',"Exam details updated successfully");
    
        //  echo json_encode(array('status'=>'true','message'=>'Question Successfully Updated','reload'=>url('admin/add_question/'.$question->exam_id)));}
  }

}

public function confirm_update_oneword(Request $request)
  {
      if($request->question_type=="oneword"){
        $question =OneWord::where('id',$request->id)->get()->first();
      }
      else {
        $question =TrueFalse::where('id',$request->id)->get()->first();
      }
      
      $rules = [
          'question' => 'required',
          'ans'=>'required',
          'marks'=>'required',
         
      ];
      $validator = Validator::make($request->all(),$rules);
  if ($validator->fails()) {
          return redirect()->back()
          ->withInput()
          ->withErrors($validator);
  } else {
          $question->question=$request->question;
          $question->answer=$request->ans;
          $question->marks=$request->marks;
          $question->status=0;
          $question->update();
          return redirect('admin/add_question/'.$question->exam_id)->with('status',"Exam details updated successfully");
    
        //  echo json_encode(array('status'=>'true','message'=>'Question Successfully Updated','reload'=>url('admin/add_question/'.$question->exam_id)));}
  }
}

public function confirm_update_match(Request $request)
  {
      $question =MatchFollowing::where('id',$request->id)->get()->first();
      $rules = [
        "lhs.*" => "required",
        "rhs.*" => "required",
        'question'=>'required',
        'marks'=>'required'
      ];
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
          return redirect()->back()
          ->withInput()
          ->withErrors($validator);
      } else {
        $question->question=$request->question;
        $i=0;
        $lhs_array=array();
        $rhs_array=array();
        foreach($request->lhs as $a){
          array_push($lhs_array,$a);
        }
        foreach($request->rhs as $a){
          array_push($rhs_array,$a);
        }
        $question->lhs=json_encode($lhs_array);
        $question->rhs=json_encode($rhs_array);
        $question->marks=$request->marks;
        $question->status=0;
        $question->update();
        return redirect('admin/add_question/'.$question->exam_id)->with('status',"Exam details updated successfully");
      }
  }


}
