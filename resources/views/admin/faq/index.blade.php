@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.faq.index') }}">faq</a>
    <a href="{{ route('admin.faq.add') }}">Add</a>
@endsection
@section('active', 'faq')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-3 mb-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="col-md-12 mb-2">
                <label for="answer">Answer</label>
                <textarea type="text" name="answer" id="answer" class="form-control"></textarea>
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
                        <th>Title</th>
                        <th>Answer</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr>
                            <td><input type="text" name="title" id="title_{{ $faq->id }}" class="form-control"
                                    value="{{ $faq->title }}"> </td>
                            <td>
                                <textarea type="text" name="answer" id="answer_{{ $faq->id }}" class="form-control">{{ $faq->answer }}</textarea>
                            </td>
                            <td>
                                <button onclick="editData({{ $faq->id }})" class="btn btn-primary">Edit</button>
                                <a href="{{ route('admin.faq.del', ['faq_id' => $faq->id]) }}"
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
            const answer = $('#answer').val();
            axios.post('{{ route('admin.faq.add') }}', {
                title: title,
                answer: answer,
            }).then(res => {
                success('succesfully added');
                location.reload()
            }).catch(err => {
                error('cannot be added');
            })
        }

        function editData(id) {
            const title = $('#title_' + id).val();
            const answer = $('#answer_' + id).val();
            axios.post('{{ route('admin.faq.edit',['faq_id'=>':id']) }}'.replace(":id",id), {
                title: title,
                answer: answer,
            }).then(res => {
                success('succesfully updated');
                location.reload()
            }).catch(err => {
                error('cannot be updated');
            })
        }
    </script>
@endsection
