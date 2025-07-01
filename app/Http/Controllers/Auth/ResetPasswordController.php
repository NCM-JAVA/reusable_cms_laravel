<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function resetpassword(){
		
		$title = "Reset Password";
        return view('auth/passwords/resetadmin',compact(['title']));
     }
	 
	 public function updatePassword(Request $request){
        $request->validate([
             'Currunt_Password' => 'required',
             'New_Password'     => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@$!%*?&]).+$/',
             'confirm_password' => 'required|same:New_Password',
        ]);
        
        $user = Auth::user();
		$currentPasswordStatus = Hash::check($request->Currunt_Password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->New_Password),
            ]);

            Auth::logout(); 
            Session::flush();

            return redirect('/admin/login')->with('reset_password', 'Password reset successful, please log in again.');
            //    return redirect()->back()->with('success', 'Password changed successfully!');

        }else{

           return redirect()->back()->withErrors(['current_password' => 'Current Password does not match with Old Password']);
		  
        } 
    }
}
