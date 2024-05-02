@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.artical_type.indexArtical') }}">Artical Type</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-3 mb-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
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
                        <th>name</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articals as $artical)
                        <tr>
                            <td><input type="text" name="name" id="name_{{ $artical->id }}" class="form-control"
                                    value="{{ $artical->name }}"> </td>
                            <td>
                                <button onclick="editData({{ $artical->id }})" class="btn btn-primary">Edit</button>
                                <a href="{{ route('admin.setting.artical_type.delArtical', ['artical_id' => $artical->id]) }}"
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
            const name = $('#name').val();
            axios.post('{{ route('admin.setting.artical_type.addArtical') }}', {
                name: name,
            }).then(res => {
                success('succesfully added');
                location.reload()
            }).catch(err => {
                error('cannot be added');
            })
        }

        function editData(id) {
            const name = $('#name_' + id).val();
            axios.post('{{ route('admin.setting.artical_type.editArtical', ['artical_id' => ':id']) }}'.replace(":id", id), {
                name: name,
            }).then(res => {
                success('succesfully updated');
                location.reload()
            }).catch(err => {
                error('cannot be updated');
            })
        }
    </script>
@endsection
