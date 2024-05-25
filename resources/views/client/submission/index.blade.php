@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
@endsection
@section('active', 'submission')
@section('toolbar')
    <a href="{{ route('client.submission.add') }}" class="btn btn-sm btn-primary d-none d-md-inline">Add New Submission</a>
@endsection
@section('content')
    @php
        $submissionStatues=submissionStatues();
        $submissionStatusColors=submissionStatusColors();
    @endphp
    <div class="shadow mt-2 py-2 d-none d-md-block">
        <div class="table-responsive ">
            <table class="table table-bordered" id="sub">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            <td>
                                {{$submission->title}}
                            </td>
                            <td class="{{$submissionStatusColors[$submission->status]}}">
                                {{$submissionStatues[$submission->status]}}
                            </td>
                            <td >
                                <div style="max-widtd: 200px;">
                                    {{substr($submission->description,0,150)}}
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary"  target="_blank" href="{{ route('client.file', ['id' => $submission->file_id]) }}">View File</a>
                                @if ($submission->status<2)
                                    <a class="btn btn-sm btn-primary"  href="{{ route('client.submission.edit', ['id' => $submission->id]) }}">Edit</a>
                                    <a class="btn btn-sm btn-danger"  href="{{ route('client.submission.del', ['id' => $submission->id]) }}" onclick="return yes('Do you want to delete submission?')">Delete</a>

                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-block d-md-none mt-3">
        <div class="text-end mb-3">
            <a class="btn btn-sm btn-primary"  href="{{ route('client.submission.add') }}">
                Add New Submission
            </a>
        </div>
        @foreach ($submissions as $submission)
            <div class="card mb-2 p-2">
                <div class="">
                    <strong>
                        Title
                    </strong>
                    <div>
                        {{$submission->title}}
                    </div>
                    <hr class="m-1">

                    <div class="d-flex justify-content-between">
                        <strong>
                            Status
                        </strong>
                        <div class="{{$submissionStatusColors[$submission->status]}}">
                            {{$submissionStatues[$submission->status]}}
                        </div>
                    </div>
                    <hr class="m-1">
                    <strong>
                        Description
                    </strong>
                    <div >
                        {{substr($submission->description,0,150)}}
                    </div>
                    <hr class="mb-2">
                    <div>
                        <a class="text-primary"  target="_blank" href="{{ route('client.file', ['id' => $submission->file_id]) }}">View File</a>
                        @if ($submission->status<2)
                            <a class="text-primary"  href="{{ route('client.submission.edit', ['id' => $submission->id]) }}">Edit</a>
                            <a class="text-danger"  href="{{ route('client.submission.del', ['id' => $submission->id]) }}" onclick="return yes('Do you want to delete submission?')">Delete</a>

                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    @include('client.layout.datatable')
    <script>
        var table;
        $(document).ready(function() {


        $('#sub').DataTable({
                columnDefs: [
                    {
                        targets: [3],
                        searchable: false,
                        orderable: false
                    }
                ]
            })
        });

    </script>
@endsection
