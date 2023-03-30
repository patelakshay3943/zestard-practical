@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container py-5 big-padding">
            <div class="row section-title">
                <h2 class="fs-5 text-center">Report</h2>
            </div>
            <div class="row mb-5">
                @foreach($candidates as $candidate)
                    <div class="col-md-6 mb-4">
                        <div class="row shado-md p-2 m-0 rounded shadow-md bg-white">
                            <div class="col-md-3">
                                <img class="rounded-pill max-130 p-2" src="{{asset($candidate->profile_image)}}" alt="">
                            </div>
                            <div class="col-md-9 align-self-center">
                                <h4 class="mt-3 fs-5 mb-1 fw-bold">{{$candidate->name}}</h4>
                                <p class="fs-8 mb-2 fw-bold">Votes : {{$candidate->total_votes}}</p>
                                <div class="progress">
                                    @php
                                        $percentage = (100 * $candidate->total_votes) / $totalVotes;

                                    @endphp
                                    <div class="progress-bar " role="progressbar" aria-label="Example with label" style="width: {{$percentage}}%;" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">{{$percentage.'%'}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
