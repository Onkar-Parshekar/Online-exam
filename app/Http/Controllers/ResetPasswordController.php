<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB; 
use App\studentDetails; 
use App\User;
use Hash; 

class ResetPasswordController extends Controller
{
    public function getPassword($token) { 

        return view('student.passwords.reset', ['token' => $token]);
     }
   
     public function updatePassword(Request $request)
     {
   
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required',
   
         ]);
             $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

            if(!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

            $user = studentDetails::where('email', $request->email)
                        ->update(['password' => $request->password, 'Cpassword' => $request->password_confirmation]);
           
                        DB::table('password_resets')->where(['email'=> $request->email])->delete();
    
            return redirect('student/student_login')->with('message', 'Your password has been changed!');
        } 
    
}
