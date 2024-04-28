@extends('admin.layout.app')
@section('header-Links')
<a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.about.about_index') }}">Policy</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-md-12 mb-2">
                <label for="description">Description</label>
                <textarea type="text" name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="col-md-12 mb-2 text-start">
                <button class="btn btn-primary" onclick="saveData()">
                    Add
                </button>
            </div>
        </div>
        <div class="row p-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abouts as $key=>$about)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><input type="text" name="title" id="title_{{ $about->id }}" class="form-control"
                                    value="{{ $about->title }}"> </td>
                            <td>
                                <textarea type="text" name="description" id="description_{{ $about->id }}" class="form-control">{{ $about->description }}</textarea>
                            </td>
                            <td>
                                <button onclick="editData({{ $about->id }})" class="btn btn-primary">Edit</button>
                                <a href="{{ route('admin.setting.about.about_del', ['about_id' => $about->id]) }}"
                                    class="btn btn-danger">Del</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function saveData() {
            const title = $('#title').val();
            const description = $('#description').val();
            axios.post('{{ route('admin.setting.about.about_add') }}', {
                title: title,
                description: description,
            }).then(res => {
                success('succesfully added');
                location.reload()
            }).catch(err => {
                error('cannot be added');
            })
        }

        function editData(id) {
            const title = $('#title_' + id).val();
            const description = $('#description_' + id).val();
            axios.post('{{ route('admin.setting.about.about_edit',['about_id'=>':id']) }}'.replace(":id",id), {
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
