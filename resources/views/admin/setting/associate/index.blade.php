@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <form id="uploads">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    @if ($title == null)
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                    @else
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$title->title}}" required>
                    @endif
                </div>
                <div class="col-md-12 mb-3">
                    <div class="shadow p-3">
                        <div class="head mb-2" style="display: flex;justify-content: space-between;">
                            <h5>Associate Upload</h5>
                            <button onclick="render()" id="addButton" class="btn btn-sm btn-primary">
                                Add
                            </button>
                        </div>
                        <div class="row mb-3" id="body">
                        </div>
                        <div class="row">
                            @foreach ($associates as $associate)
                            <div class="col-md-4 mb-2 " style="position: relative">
                                <input type="file" name="image_{{$associate->id}}" accept="image/*" data-default-file="{{vasset($associate->image)}}" class="form-control photo">
                                <input type="text" name="link_{{$associate->id}}" class="form-control" value="{{$associate->link}}" placeholder="Link">
                                <button type="button" class="btn btn-square btn-danger" style="position:absolute;top:0px;right:15px;z-index:99999;" onClick="removefile({{$associate->id}})">&times;</button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-start">
                    <button class="btn btn-primary" onclick="saveAll()">
                        Save All
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('addButton').addEventListener('click', function(event) {
            event.preventDefault();
        });
        let index = 0;

        function render() {
            $('#body').append(`
            <div class="col-md-4" id="fileinput_${index}" >
                <input type="hidden" name="ids[]"  value="${index}">
                <input type="file" name="image_${index}" accept="image/*" class="form-control photo">
                <input type="text" name="link_${index}" class="form-control" placeholder="Link">
            </div>`);
            index++;
            $('.photo').dropify();
        }

        function saveAll() {
            const ele = document.getElementById('uploads');
            let formData = new FormData(ele);
            $('#body input[type="file"]').each(function() {
                let name = $(this).attr('name');
                let files = $(this).prop('files');
                if (files.length > 0) {
                    formData.append(name, files[0]);
                }
            });
            axios.post("{{ route('admin.setting.associate.index') }}", formData)
                .then((res) => {
                    success('succesfully added')
                    $('#body').html("");
                }).catch((err) => {
                    error('Cannot be saved');
                });
        }
        function removefile(id){
            axios.get('{{route('admin.setting.associate.del',['id'=>":id"])}}'.replace(':id',id))
            .then(res => {
            success('successfully deleted')
            location.reload()
            })
            .catch(err => {
                console.error(err);
            })
        }
    </script>
@endsection
