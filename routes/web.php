<?php

use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\ElectionDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CandidateController::class,'index'])->name('candidate.index');
Route::post('submit-send-otp-vote',[CandidateController::class,'sendOTP'])->name('submit.send-otp.vote');
Route::post('submit-vote',[CandidateController::class,'submitVote'])->name('submit.vote');
Route::get('test',[TestController::class,'test']);
Auth::routes();

Route::get('/election-data', [ElectionDataController::class, 'index'])->name('election.index');
Route::get('/election-report', [ElectionDataController::class, 'ElectionReport'])->name('election.report');
