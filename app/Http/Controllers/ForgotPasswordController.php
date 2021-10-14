<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use Mail; 
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
  public function getEmail()
  {

     return view('student.passwords.email');
  }

 public function postEmail(Request $request)
  {
    $request->validate([
        'email' => 'required|email|exists:student_Details',
       
    ]);

    $token = Str::random(60);

      DB::table('password_resets')->insert(
          ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
      );

      Mail::send('student.verify', ['token' => $token], function($message) use($request){
          $message->to($request->email)
            ->subject('Reset Password Notification');
      });
      
      return back()->with('message', 'We have e-mailed your password reset link!');
     
  }
}