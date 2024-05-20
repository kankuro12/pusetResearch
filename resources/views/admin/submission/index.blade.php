@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.submission.index') }}">Submission</a>
@endsection
@section('toolbar')
    {{-- <a href="{{ route('admin.submission.add') }}" class="btn btn-primary btn-sm">Add</a> --}}
@endsection
@section('active', 'submission')
@section('content')
    <style>
        #detail *{
            font-size: 14px;
        }
    </style>
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
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="detailCanvas" aria-labelledby="detailCanvasLabel" style="height: 90vh;">
        <div class="offcanvas-header d-flex justify-content-between">
          <h5 class="offcanvas-title" id="detailCanvasLabel">Submission Detail</h5>
          <span>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </span>
        </div>
        <div class="offcanvas-body large p-0" >
            <div class="px-3" style="min-height: 400px;">
                <div class="row">
                    <div class="col-md-3"  id="detail">

                    </div>
                    <div class="col-md-9" style="height:78vh">
                        <iframe src="" id="preview" style="width: 100%;height:100%;" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="d-none" id="submissions">{!! json_encode($submissions, JSON_NUMERIC_CHECK) !!}</div>
@endsection
@section('js')
    @include('admin.layout.datatable')
    <script>
        var table;
        var submissions;
        var offCanvas;
        function getFileUrl(submission){
            return ("{{route('admin.file',['id'=>'xxx_id'])}}".replaceAll('xxx_id',submission.file_id))+"?name="+submission.file_path;
        }
        const submissionStatusColors = {!! json_encode(submissionStatusColors(), JSON_NUMERIC_CHECK) !!}

        $(document).ready(function() {
            submissions = (JSON.parse($('#submissions').text())).map((submission) => {
                return {
                    id: submission.id,
                    user_id: submission.uid,
                    title: submission.t,
                    status: submission.s,
                    description: submission.d,
                    created_at: submission.c,
                    updated_at: submission.u,
                    file_id: submission.f,
                    file_path: submission.p,
                    file_ext: submission.p.split(".")[1],
                    name: submission.n,
                    affiliation: submission.a,
                    created: new Date(submission.c),
                    updated: new Date(submission.u),
                }
            });
            $('#submissions').remove();

            $('#status').append(submissionStatues.map((status, index) =>
                `<option value="${index}">${status}</option>`))
            loadData();
            $('#status').change(function(e) {
                loadData();
                console.log('ddd');
            });
            console.log(submissions);
            offCanvas = new bootstrap.Offcanvas( document.getElementById('detailCanvas'))
        });

        function render(submission, index) {
            return `<tr>
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
                        <span onclick="showDetail(${submission.id})" class="btn btn-sm btn-primary">Detail</span>
                    </td>
                </tr>`
        }

        function showDetail(id){
            const submission=submissions.find(o=>o.id==id);
            if(submission){
                offCanvas.show();
                const url=getFileUrl(submission);
                $('#detail').html(`<div>
                    <strong>Title</strong><br>
                    <small>${submission.title}</small>
                    <hr class="my-1">
                    <strong>Description</strong><br>
                    <small>${submission.description}</small>
                    <hr class="my-1">
                    <strong>Submitted By</strong><br>
                    <small>${submission.name}</small>
                    <hr class="my-1">
                    <strong>Submitter Affiliation</strong><br>
                    <small>${submission.affiliation}</small>
                    <hr class="my-1">
                    <strong>
                        <a href="${url}" target="_blank" download="${submission.title}.${submission.file_ext}">
                            Download File
                        </a>
                    </strong>
                </div>`);
                $('#preview').attr('src',url);
            }
        }

        function loadData() {
            const status = parseInt($('#status').val()) || -1;
            let localSubmissions = [];
            if (status == -1) {
                $('#submissions-table tbody').html(submissions.map(render).join(''));

            } else {
                localSubmissions = submissions.filter(o => o.status == status);
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
