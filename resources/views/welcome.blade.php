@extends('layouts.front_layout')

@section('content')
    <div class="container-xl big-padding">
        <div class="row section-title">
            <h2 class="fs-4">Vote</h2>
        </div>
        <div class="row">
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                    <i class="start-icon far fa-check-circle faa-tada animated"></i>
                    {{ \Illuminate\Support\Facades\Session::get('success') }}
                </div>
            @endif
        </div>

        @if(\Illuminate\Support\Facades\Session::has('sentOTP'))
            <form action="{{route('submit.vote')}}" method="POST" id="voteForm">
                @csrf
        @else
            <form action="{{route('submit.send-otp.vote')}}" method="POST" id="voteForm">
                @csrf
        @endif

            <div class="row" role="group" aria-label="Basic radio toggle button group">
                @foreach($candidates as $key => $candidate)
                    <div class="col-lg-3 col-md-6">
                        <div class="text-white text-center mb-4 votcard shadow-md bg-white p-4 pt-5">
                            <img class="rounded-pill shadow-md p-2" src="{{asset($candidate->profile_image)}}" alt="">
                            <h4 class="mt-3 fs-5 mb-1 fw-bold">{{$candidate->name}}</h4>
                            <input @if(\Illuminate\Support\Facades\Session::has('sentOTP')) disabled @endif type="radio" class="btn-check candidate-check" {{old('candidate') == $candidate->id ? 'checked' : ''}} value="{{$candidate->id}}" name="candidate" id="btnradio{{$key}}" autocomplete="off">
                            <label class="btn btn-outline-danger fw-bolder px-4 ms-2 fs-8" for="btnradio{{$key}}">Vote</label>
                        </div>
                    </div>
                @endforeach
                @error('candidate')
                    <label class="error" style="text-align: center;">{{$message}}</label>
                @enderror
            </div>
            <div class="row align">
                <div class="col-lg-4 col-md-6">
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Name</label>
                        <input type="text" @if(\Illuminate\Support\Facades\Session::has('sentOTP')) disabled @endif name="name" value="{{old('candidate')}}" class="form-control" id="fullName" placeholder="Name">
                        @error('name')
                            <label class="error">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email address</label>
                        <input type="email" @if(\Illuminate\Support\Facades\Session::has('sentOTP')) disabled @endif name="email" value="{{old('email')}}" class="form-control" id="emailAddress" placeholder="Email Address">
                        @error('email')
                            <label class="error">{{$message}}</label>
                        @enderror
                        @if(\Illuminate\Support\Facades\Session::has('error'))
                            <label class="error">{{ \Illuminate\Support\Facades\Session::get('error') }}</label>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" @if(\Illuminate\Support\Facades\Session::has('sentOTP')) disabled @endif name="phone_number" value="{{old('phone_number')}}" class="form-control" id="phoneNumber" placeholder="Phone Number">
                        @error('phone_number')
                            <label class="error">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="MemberId" class="form-label">Member ID</label>
                        <input type="text" @if(\Illuminate\Support\Facades\Session::has('sentOTP')) disabled @endif name="member_id" value="{{old('member_id')}}" class="form-control" id="MemberId" placeholder="Member Id">
                        @error('member_id')
                            <label class="error">{{$message}}</label>
                        @enderror
                    </div>
                    @if(\Illuminate\Support\Facades\Session::has('sentOTP'))
                        <input type="hidden" name="name"  value="{{old('name')}}">
                        <input type="hidden" name="email"  value="{{old('email')}}">
                        <input type="hidden" name="phone_number" value="{{old('phone_number')}}">
                        <input type="hidden" name="member_id"  value="{{old('member_id')}}">
                        <input type="hidden" name="candidate"  value="{{old('candidate')}}">
                        @if(!\Illuminate\Support\Facades\Session::has('invalidOTP'))
                            <label class="success">{{ \Illuminate\Support\Facades\Session::get('sentOTP') }}</label>
                        @else
                            <label class="error">{{ \Illuminate\Support\Facades\Session::get('invalidOTP') }}</label>
                        @endif
                        <div class="mb-3">
                            <label for="OTP" class="form-label">OTP</label>
                            <input type="text" name="otp" value="" class="form-control" id="OTP" placeholder="Enter OTP">
                        </div>
                    @endif
                    <div class="mb-3 text-center">
                        @if(\Illuminate\Support\Facades\Session::has('sentOTP'))
                            <input type="submit" class="btn btn-primary" value="Submit">
                        @else
                            <input type="submit" class="btn btn-primary" value="Get OTP">
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                </div>
            </div>
        @if(\Illuminate\Support\Facades\Session::has('sentOTP'))
            </form>
        @else
            </form>
        @endif
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $("#voteForm").validate({
            rules: {
                candidate: {
                    required: true,
                },
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email:true,
                },
                phone_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,
                },
                member_id: {
                    required: true,
                },
                otp:{
                    required:true,
                }
            },
            messages: {
                candidate: {
                    required: "Please select candidate any one for your vote.",
                },
                name: {
                    required: "Please enter name",
                },
                email: {
                    required: "Please enter email address",
                    email: "Please enter a valid email address.",
                },
                phone_number: {
                    required: "Please enter phone number",
                    number: "Please enter valid phone number",
                    minlength: "Phone number field accept only 10 digits",
                    maxlength: "Phone number field accept only 10 digits",
                },
                member_id: {

                },
                otp:{
                    required: 'please enter valid OTP.',
                }
            },
            errorPlacement: function(error, element) {
                if($(element).hasClass('candidate-check'))
                {
                    error.css({'text-align':'center'}).appendTo($(element).parent().parent().parent());
                }
                else
                {
                    error.insertAfter(element);
                }
            },
        });
    </script>
@endpush
