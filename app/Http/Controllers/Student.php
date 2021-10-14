<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Course;
use App\studentDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Session;

use Illuminate\Support\Facades\Mail;


class Student extends Controller
{
    public function student_signup()
    {
        if(Session::get('student_session'))
        {
            return redirect(url('student/student_dashboard'));
        }
        $data['course'] = Course::get()->toArray();
        return view('student.signup',$data);

    }

    public function add_new_student(Request $request)
    {
        $rules = [
            'PRNo' => 'required|unique:student_details|exists:studentid,id',
            'Fname'=>'required',
            'Lname'=>'required',
            'email' =>'required|unique:student_details',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required',
            'rollNo'=>'required|integer',
            'course'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('student/signup')
			->withInput()
			->withErrors($validator);
		}
		else {
            $cat = new studentDetails(); 
            $cat->PRNo=$request->PRNo;
            $cat->Fname=$request->Fname;
            $cat->Lname=$request->Lname;
            $cat->email=$request->email;
            $cat->password=$request->password;
            $cat->Cpassword=$request->password_confirmation;
            $cat->rollNO=$request->rollNo;
            $cat->course=$request->course;
            $cat->save();

               //email data   
               $email_data = array(
                'name' => $request['Fname'],
                'email' => $request['email'],
            );  

                //Send email with the template
            Mail::send(['text'=>'mail'], $email_data, function($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Successfull Registration');
                $message->from('pinroad47developer@gmail.com', 'Minaxi Patil');
        });
            return redirect('student/student_login');
        }
    }

    public function student_login()
    {
        if(Session::get('student_session'))
        {
            return redirect(url('student/student_dashboard'));
        }
        return view('student.student_login');
    }

    public function stud_login(Request $request)
    {
        $login=studentDetails::where('email',$request->email)->where('password',$request->password)->get()->toArray();
        if($login)
        {
            $request->session()->put('student_email',$login[0]['email']);
            $request->session()->put('student_session',$login[0]['Fname']);
            $request->session()->put('student_course',$login[0]['course']);
            $request->session()->put('student_prno',$login[0]['PRNo']);
            $request->session()->put('student_rollno',$login[0]['rollNo']);
            $request->session()->put('student_rollno12',0);
            return redirect('student/student_dashboard');
        }
        else
        {
            // echo '<script>alert("You have entered invalid credentials")</script>';
            $errors=new MessageBag(['password'=>['Invalid Username/Password']]);
            return redirect('student/student_login')
            ->withInput()
            ->withErrors($errors);
        }

    }
}
