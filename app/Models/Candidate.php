<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(string[] $item, string[] $array)
 */
class Candidate extends Model
{
    use HasFactory;

    public function CandidateVotes(){
        return $this->hasMany(CandidateVote::class,'id','candidate_id');
    }
}
