<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;
use App\Models\Candidate;
use App\Models\CandidateVote;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    public function index(){
        $candidates = Candidate::all();
        return view('welcome',compact('candidates'));
    }

    public function sendOTP(Request $request){
        $validate = Validator::make($request->all(), [
            'candidate' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|digits:10',
            'member_id' => 'required',
        ],[
            'candidate.required' => 'Please select any one candidate for your vote.',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $details['email'] = $request->email;
        $details['name'] = $request->name;
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $otp = substr(str_shuffle($str_result),0, 6);
        $details['otp'] = $otp;
        $user = User::where('email',$request->email)->first();
        if(!isset($user))
        {
            $user = new User();
        }
        else{
            if(filled($user->otp_verified_at)){
                Session::flash('error', "You are already voted.");
                return redirect()->back()->withInput();
            }
        }
        $user->name = $request->name;
        $user->otp = $otp;
        $user->email = $request->email;
        $user->member_id = $request->member_id;
        $user->phone_number = $request->phone_number;
        $user->save();
        Mail::to($details['email'])->queue(new SendOTP($details));
        Session::flash('sentOTP', "OTP has been successfully sent.");
        return redirect()->back()->withInput();
    }
    public function submitVote(Request $request){
        $otp = $request->otp;
        $email = $request->email;
        $candidate = $request->candidate;
        $user = User::where('email',$email)->first();
        if($user->otp == $otp)
        {
            $user->otp_verified_at = Carbon::now('UTC');
            $user->save();

            $candidateVote = new CandidateVote();
            $candidateVote->user_id = $user->id;
            $candidateVote->candidate_id = $candidate;
            $candidateVote->save();
            Session::flash('success', "Your vote is successfully submitted.");
            return redirect()->back();
        }
        else{
            Session::flash('invalidOTP', "OTP is invalid");
            Session::flash('sentOTP', "OTP is invalid");
            return redirect()->back()->withInput();
        }

    }
}
