<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property mixed candidate_id
 * @method static whereHas(string $string, \Closure $param)
 */
class CandidateVote extends Model
{
    use HasFactory;

    public function User(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function Candidate(){
        return $this->hasOne(Candidate::class,'id','candidate_id');
    }
}
