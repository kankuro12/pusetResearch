@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.submission.index') }}">Submission</a>
@endsection
@section('toolbar')
    {{-- <a href="{{ route('admin.submission.add') }}" class="btn btn-primary btn-sm">Add</a> --}}
@endsection
@section('active', 'submission')
@section('content')
<div class="shadow p-3 mt-3 br-3 bg-white">

    <div class="row">
        <div class="col-md-4">
            <label for="status">Submission Status</label>
            <select name="status" id="status" class="form-control mt-2">
                <option value="-1">All</option>
            </select>
        </div>
    </div>
</div>

    <div class="shadow p-3 mt-3 br-3 bg-white">
        <div class="table-responsive">
            <table class="table table-bordered" id="submissions-table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Affiliation</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody >

                </tbody>
            </table>
        </div>
    </div>

    <div class="d-none" id="submissions">{!! json_encode($submissions,JSON_NUMERIC_CHECK) !!}</div>
@endsection
@section('js')
    @include('admin.layout.datatable')
    <script>
        var table;
        var submissions;

        const submissionStatusColors={!! json_encode(submissionStatusColors(),JSON_NUMERIC_CHECK) !!}

        $(document).ready(function () {
            submissions=(JSON.parse($('#submissions').text())).map((submission)=>{
                return {
                    id:submission.id,
                    user_id:submission.uid,
                    title:submission.t,
                    status:submission.s,
                    description:submission.d,
                    created_at:submission.c,
                    updated_at:submission.u,
                    file_id:submission.f,
                    name:submission.n,
                    affiliation:submission.a,
                    created:new Date(submission.c),
                    updated:new Date(submission.u),
                }
            });
            $('#submissions').remove();

            $('#status').append(submissionStatues.map((status,index)=>`<option value="${index}">${status}</option>`))
            loadData();
            $('#status').change(function (e) {
                loadData();
                console.log('ddd');
            });
            console.log(submissions);
        });

        function render(submission,index){
            return   `<tr>
                    <td>
                        ${index+1}
                    </td>
                    <td>
                        ${submission.title}
                    </td>
                    <td>
                        ${submission.name}
                    </td>
                    <td>
                        ${submission.affiliation}
                    </td>
                    <td class=" ${submissionStatusColors[submission.status]}">
                        ${submissionStatues[submission.status]}
                    </td>
                    <td>
                        ${submission.created_at}
                    </td>
                    <td>
                        <span class="btn btn-sm btn-primary">Detail</span>
                    </td>
                </tr>`
        }

        function loadData(){
            const status=parseInt($('#status').val())||-1;
            let localSubmissions=[];
            if(status==-1){
                $('#submissions-table tbody').html(submissions.map(render).join(''));

            }else{
                localSubmissions = submissions.filter(o=>o.status==status);
                $('#submissions-table tbody').html(localSubmissions.map(render).join(''));
            }

        }

        function updateStatus(id) {
            const status = $('#status_' + id).val();
            const data = {
                status: status
            };

            axios.post(`/admin/submission/edit/${id}`, data)
                .then(response => {
                    success('successfully updated')
                    // table.ajax.reload();
                    location.reload()
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }

        function getUrls(id) {
            const delURL = "{{ route('admin.submission.del', ['sub_id' => 'xxx_id']) }}";
            return `<a href="#" class="btn btn-sm btn-primary" onclick="updateStatus(${id})">Update</a>
                    <a onclick="return yes()" href="${delURL.replace('xxx_id', id)}" class="btn btn-sm btn-danger">Delete</a>`;
        }
    </script>
@endsection
