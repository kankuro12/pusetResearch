@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.about.about_index') }}">About</a>
    <a href="{{ route('admin.setting.about.about_edit',['about_id'=>$about->id]) }}">Edit</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $about->title }}">
            </div>
            <div class="col-md-3">
                <label for="sub_title">Sub Title</label>
                <input type="text" name="sub_title" id="sub_title" class="form-control" value="{{ $about->sub_title }}">
            </div>
            <div class="col-md-12 mb-2">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description" class="form-control">{{ $about->description }}</textarea>
            </div>
            <div class="col-md-12 mb-2 text-start">
                <button class="btn btn-primary btn-sm" onclick="editData({{ $about->id }})">
                    Edit
                </button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function editData(id) {
            const title = $('#title').val();
            const sub_title = $('#sub_title').val();
            const description = $('#description').val();
            axios.post('{{ route('admin.setting.about.about_edit', ['about_id' => ':id']) }}'.replace(":id", id), {
                title: title,
                sub_title: sub_title,
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
