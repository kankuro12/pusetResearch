@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-2">
                    @if ($title == null)
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    @else
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $title->title }}"
                            required>
                    @endif
                </div>
                <div>
                    <button class="btn btn-danger btn-primary">Save Title</button>
                </div>
            </div>

        </form>
    </div>
    <div class="shadow mt-2 p-3 bg-white rounded">
        <div class="head mb-2" style="display: flex;justify-content: space-between;">
            <h5>Associates</h5>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3 " style="position: relative">
                <form action="{{ route('admin.setting.associate.add') }}" method="POST" enctype="multipart/form-data"
                    class="shadow">
                    @csrf
                    <input type="file" name="image" accept="image/*" class="form-control photo" required>
                    <input type="text" name="link" class="form-control no-radius" placeholder=" Enter URL" required>
                    <div class="row m-0">
                        <div class="col-md-12 p-0">
                            <button class="btn btn-primary btn-save no-radius w-100">Save Associate</button>
                        </div>
                    </div>
                </form>
            </div>
            @foreach ($associates as $associate)
                <div class="col-md-4 mb-3 " style="position: relative" id="data-{{ $associate->id }}">
                    <form action="{{ route('admin.setting.associate.edit') }}" method="POST" enctype="multipart/form-data"
                        class="shadow">
                        @csrf
                        <input type="hidden" name="id" value="{{ $associate->id }}">
                        <input type="file" name="image" accept="image/*"
                            data-default-file="{{ asset($associate->image) }}" class="form-control photo">
                        <input type="text" name="link" class="form-control no-radius"
                            value="{{ $associate->link }}" placeholder="Link" required>
                        <div class="row m-0">
                            <div class="col-md-12 p-0">
                                <button class="btn btn-primary btn-save no-radius w-100">Save Associate</button>
                            </div>
                        </div>
                        <a href="{{route('admin.setting.associate.del',['id'=>$associate->id])}}" type="button" class="btn btn-square btn-danger"
                            style="position:absolute;top:0px;right:15px;z-index:99999;" onClick="return yes();">&times;</a>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
