@extends('layouts.app')

@section('content')
<div class="container">
    <table id="electionData" class="table table-bordered yajra-datatable">
        <thead>
        <tr>
            <th>Member ID</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Voted Candidate Name</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('#electionData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('election.index') }}",
                columns: [
                    {data: 'member_id', name: 'member_id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'voted_candidate_name', name: 'voted_candidate_name'},
                ]
            });

        });
    </script>
@endpush
