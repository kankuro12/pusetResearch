@extends('client.layout.app')
@section('header-link')
    <a href="{{ route('client.submission.index') }}">Submissions</a>
@endsection
@section('active', 'submission')
@section('toolbar')
    <a href="{{ route('client.submission.add') }}" class="btn btn-sm btn-primary">Add New Submission</a>
@endsection
@section('content')
    <div class="shadow mt-2 p-2">
        <div class="table-responsive">
            <table class="table table-bordered" id="sub">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                @php
                    $submissionStatues=submissionStatues();
                    $submissionStatusColors=submissionStatusColors();
                @endphp
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
                                @if ($submission->status<2)
                                    <a class="btn btn-sm btn-primary"  href="{{ route('client.submission.edit', ['id' => $submission->id]) }}">Edit</a>
                                    <a class="btn btn-sm btn-danger"  href="{{ route('client.submission.del', ['id' => $submission->id]) }}">Delete</a>

                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
