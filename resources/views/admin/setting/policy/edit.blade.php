@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.policy.policy_index') }}">Policies</a>
    <a href="{{ route('admin.setting.policy.policy_edit', ['policy_id' => $policy->id]) }}">Edit</a>
@endsection
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $policy->title }}">
            </div>
            <div class="col-md-12 mb-2">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description" class="form-control note"> {{ $policy->description }} </textarea>
            </div>
            <div class="col-md-12 mb-2 text-start">
                <button class="btn btn-primary btn-sm" onclick="editData({{ $policy->id }})">
                    Update
                </button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function editData(id) {
            const title = $('#title').val();
            const description = $('#description').val();
            axios.post('{{ route('admin.setting.policy.policy_edit', ['policy_id' => ':id']) }}'.replace(":id", id), {
                title: title,
                description: description,
            }).then(res => {
                success('succesfully updated');
                location.reload()
            }).catch(err => {
                error('cannot be updated');
            })
        }
    </script>
@endsection
