<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use App\Tsubject;
use App\studentSubjects;
use App\exam_creates;
use App\exam_question_master;
use App\OneWord;
use App\TrueFalse;
use App\MatchFollowing;
use App\result;
use Illuminate\Support\Facades\Mail;

class StudentActivity extends Controller
{
    public function student_dashboard(Request $request)
    {
        if(!Session::get('student_session'))
        {
            return redirect(url('student/student_login'));
        }
        $coursename = $request->session()->get('student_course');
        $prno = $request->session()->get('student_prno');
        $data['display_subject']=Tsubject::select(['tsubject.subject_name','users.name'])
        ->join('users', 'tsubject.teacher_id','=','users.uid')
         ->where('tsubject.course_name','=',$coursename)
        ->where('tsubject.status','=','1')
        ->whereNotIn('tsubject.subject_name', studentSubjects::select(['student_subjects.subjectName'])
        ->where('student_subjects.studentNo','=',$prno))
        ->get()->toArray();
        return view('student.student_dashboard',$data);
    }

    public function student_logout(Request $request)
    {
        $request->session()->forget('student_session');
        return redirect(url('http://127.0.0.1:8000/'));
        
    }

    public function enroll($subject_name)
    {
        $data['subj'] =Tsubject::where('subject_name',$subject_name)->get()->first();
        return view('student.enroll',$data);
    }

    public function verify_enroll(Request $request)
    {
        $cat =Tsubject::where('subject_name',$request->id123)->get()->first();
        $rules = [
            'enrollkey' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->back()
			->withInput()
			->withErrors($validator);
		}
		else {
            if($cat->enrollment_key == $request->enrollkey)
            {
                $enr = new studentSubjects();
                $enr->subjectName=$cat->subject_name;
                $enr->studentNo=$request->session()->get('student_prno');
                $enr->rollNo=$request->session()->get('student_rollno');
                $enr->course=$request->session()->get('student_course');
                $enr->save();
                return redirect('student/student_subjects')->with('status',"Enrolled for subject successfully");
            }
            else
            {
                $errors = new MessageBag(['enrollkey' => ['Invalid Enrollment Key']]);
                return redirect()->back()
			    ->withInput()
			    ->withErrors($errors);
            }
        }
    }

    public function student_subjects(Request $request )
    {
        if(!Session::get('student_session'))
        {
            return redirect(url('student/student_login'));
        }
        
        $prno = $request->session()->get('student_prno');
        $data['display_subject']=studentSubjects::select(['student_subjects.subjectName','tsubject.subject_code'])
        ->join('tsubject', function($join) use($prno)
        {
            $join->on('tsubject.subject_name','=','student_subjects.subjectName')
            ->where('student_subjects.studentNo','=',$prno);
                
        })->get()->toArray();
        return view('student.student_subject',$data);
    }

    public function exam(Request $request) {
        // header("refresh:0");
        if(!Session::get('student_session'))
        {
            return redirect(url('student/student_login'));
        }
        $prno = $request->session()->get('student_prno');
        $data['isanswering'] = $request->session()->get('student_rollno12');
        
        $data['examans']=exam_creates::select(['exam_creates.id','exam_creates.exam_title','exam_creates.duration','exam_creates.exam_date','exam_creates.status','exam_creates.subjectName'])
        ->join('tsubject', 'tsubject.subject_name','=','exam_creates.subjectName')
        ->join('student_subjects','student_subjects.subjectName','=','tsubject.subject_name')
        ->whereNotIn('exam_creates.id', result::select(['results.exam_id'])->where('results.studentId','=',$prno))
        
        ->where('student_subjects.studentNo','=',$prno)
        ->where('exam_creates.status',1)
        
        ->get()->toArray();

        return view('student.student_exam',$data);
    }

    public function join_exam($id,Request $request)
    {
        
        $data['mcq_questions']=exam_question_master::where('exam_id',$id)->where('status',1)->get()->toArray();
        $data['onefill_questions']=OneWord::where('exam_id',$id)->where('status',1)->get()->toArray();
        $data['truefalse_questions']=TrueFalse::where('exam_id',$id)->where('status',1)->get()->toArray();
        $data['match_questions']=MatchFollowing::where('exam_id',$id)->where('status',1)->get()->toArray();
        $data['marks']=exam_creates::select(['exam_creates.total_marks','exam_creates.duration'])->where('exam_creates.id','=',$id)->get()->toArray();
        $request->session()->put('student_rollno12',1);
        
        return view('student.exam_paper',$data);
    }


    // public function join_exam12($id)
    // {
    //     return view('student.exam_paper'.$id);
    // }







    public function submit_exam(Request $request)
    {


        $request->session()->put('student_rollno12',0);
        $check=result::select(['exam_id','studentId','marks'])->where('exam_id','=',$request->exam_id)->where('studentId','=',$request->session()->get('student_prno'))->get()->first();
        if($check){
              echo "<script>alert('Already Attempted');window.location.href='show_result'</script>";
            
            // return redirect(url('student/exam'))->with('message','Already Attempted');
            
        }
        else{
        $data = $request->all();
        $mcqresult = array();
        $onefillresult = array();
        $trueresult = array();
        $matchresult = array();
        $total=0;
       
        for($i=1; $i<=$request->mcqquest; $i++)
        {
            if(isset($data['mcq'.$i])){
                $getQuestion = exam_question_master::where('id',$data['mcq'.$i])->get()->first();
                if($getQuestion->answer == $data['ans'.$i]){
                    $mcqresult[$data['mcq'.$i]]='YES';
                    $total=$total+$getQuestion->marks;
                }
                else {
                    $mcqresult[$data['mcq'.$i]]='NO';
                }
            }
        }
        for($i=1; $i<=$request->fillquest; $i++)
        {
            if(isset($data['onefill'.$i])){
                $getQuestion = OneWord::where('id',$data['onefill'.$i])->get()->first();
                if(strcasecmp ($getQuestion->answer,$data['oneanswer'.$i])==0){
                    $onefillresult[$data['onefill'.$i]]='YES';
                    $total=$total+$getQuestion->marks;
                }
                else {
                    $onefillresult[$data['onefill'.$i]]='NO';
                }
            }
        }
        for($i=1; $i<=$request->truequest; $i++)
        {
            if(isset($data['tf'.$i])){
                $getQuestion = TrueFalse::where('id',$data['tf'.$i])->get()->first();
                if($getQuestion->answer == $data['answ'.$i]){
                    $trueresult[$data['tf'.$i]]='YES';
                    $total=$total+$getQuestion->marks;
                }
                else {
                    $trueresult[$data['tf'.$i]]='NO';
                }
            }
        }
        for($i=1; $i<=$request->matchquest; $i++)
        {
            if(isset($data['mf'.$i])){
                $getQuestion = MatchFollowing::where('id',$data['mf'.$i])->get()->first();
                $rhsoptions = json_decode(json_encode(json_decode($getQuestion->rhs)),true);
                $lhsoptions = json_decode(json_encode(json_decode($getQuestion->lhs)),true);
                $flag=0;
                $b=0;$a=0;
                foreach($rhsoptions as $anskey) {
                   $a=$a+1;
                    if($anskey == $data[$lhsoptions[$flag]]){
                        $matchresult[$lhsoptions[$flag]]='YES';
                        $b=$b+1;
                    }
                    else {
                        $matchresult[$lhsoptions[$flag]]='NO';
                    }   
                    $flag = $flag + 1;
                }
                $total=$total+(($getQuestion->marks/$a)*$b);
            }
        }
        

        
        $res=new result();

        $res->exam_id=$request->exam_id;
        $res->studentId=$request->session()->get('student_prno');
        $res->marks=$total;
        $res->save();
        $data2['examdetails']=exam_creates::select(['exam_creates.total_marks','exam_creates.exam_title'])->where('exam_creates.id','=',$request->exam_id)->get()->toArray();
        $data2['mcq_questions']=exam_question_master::where('exam_id',$request->exam_id)->where('status',1)->get()->toArray();
        $data2['onefill_questions']=OneWord::where('exam_id',$request->exam_id)->where('status',1)->get()->toArray();
        $data2['truefalse_questions']=TrueFalse::where('exam_id',$request->exam_id)->where('status',1)->get()->toArray();
        $data2['match_questions']=MatchFollowing::where('exam_id',$request->exam_id)->where('status',1)->get()->toArray();
        $total = round($total,2);

        //email data   
        $email_data = array(
            'name' => $request->session()->get('student_session'),
            'email' => $request->session()->get('student_email'),
        );  

            //Send email with the template
        Mail::send(['text'=>'answerMail'], $email_data, function($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Exam answered successfully');
                $message->from('pinroad47developer@gmail.com', 'Minaxi Patil');
    });





        return view('student.show_result',$data2)->withTitle($total)->with('answers', $data);
        }
    }

    // public function show_result($id)
    // {

    // }


    public function show_result(Request $request) {
        if(!Session::get('student_session'))
        {
            return redirect(url('student/student_login'));
        }
        $prno = $request->session()->get('student_prno');
        $data['res']=result::select(['results.exam_id','results.marks','exam_creates.subjectName','exam_creates.exam_title','exam_creates.total_marks'])
        ->join('exam_creates', 'exam_creates.id','=','results.exam_id')
        ->where('results.studentId','=',$prno)
        ->get()->toArray();
        
        return view('student.result',$data);
    }
    
}
 