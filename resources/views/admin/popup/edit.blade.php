@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.popup.index') }}">PopUps</a>
    <a href="#">Edit Popup</a>

@endsection

@section('content')
<div class="bg-white shadow p-3">

    <form action="{{ route('admin.popup.edit', ['popup_id' => $popup->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class=" mb-2 col-md-6">
                <div class="form-group">
                    <label>Desktop Image</label>
                    <input type="file" name="desktop_image" class="form-control photo" accept="image/*"  data-default-file="{{ asset($popup->desktop_image) }}" />

                </div>

            </div>
            <div class=" mb-2 col-md-6">
                <div class="form-group">
                    <label>Mobile Image</label>
                    <input type="file" name="mobile_image" class="form-control photo" accept="image/*" data-default-file="{{ asset($popup->mobile_image) }}" />

                </div>
            </div>
            <div class=" mb-2 col-md-8">

                        <div class="form-group ">
                            <label>Link</label>
                            <input type="text" name="link" value="{{ $popup->link }}" class="form-control" />
                        </div>

            </div>
            <div class=" mb-2 col-md-4">
                <div class="form-group">
                    <label><input type="checkbox" name="active" {{ $popup->active? 'checked':'' }} /> Active</label>
                </div>

            </div>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
