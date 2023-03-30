<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateVote;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ElectionDataController extends Controller
{
    public function index(Request $request){
        if($request->ajax())
        {
            $votes = CandidateVote::with(['User','Candidate'])->get();

            return Datatables::of($votes)
                ->addIndexColumn()
                ->addColumn('member_id', function($row){
                    return $row->User->member_id;
                })
                ->addColumn('name', function($row){
                    return $row->User->name;
                })
                ->addColumn('email', function($row){
                    return $row->User->email;
                })
                ->addColumn('phone_number', function($row){
                    return $row->User->phone_number;
                })
                ->addColumn('total_likes', function($row){
                    return $row->User->phone_number;
                })
                ->addColumn('voted_candidate_name', function($row){
                    return $row->Candidate->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('home');
    }

    public function ElectionReport(Request $request){

        $candidates = Candidate::with('CandidateVotes')
            ->addSelect([
                'total_votes' => CandidateVote::selectRaw('count(*)')->whereColumn('candidate_id','candidates.id')
            ])->get();
        $totalVotes = CandidateVote::all()->count();

        return view('election_report',compact('candidates','totalVotes'));
    }
}
