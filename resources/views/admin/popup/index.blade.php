@extends('admin.layout.app')
@section('toolbar')
    <a href="{{ route('admin.popup.add') }}" class="btn btn-sm btn-success">Add Popup</a>

@endsection
@section('header-Links')
<a href="#">PopUps</a>

@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            @if(isset($popups) && count($popups))
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Desktop Image</th>
                            <th>Mobile Image</th>
                            <th>Link</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($popups as $popup)
                            <tr>
                                <td>{{ $popup->id }}</td>
                                <td>
                                    @if($popup->desktop_image)
                                        <img src="{{ asset($popup->desktop_image) }}" style="max-width:120px;height:auto;" />
                                    @endif
                                </td>
                                <td>
                                    @if($popup->mobile_image)
                                        <img src="{{ asset($popup->mobile_image) }}" style="max-width:80px;height:auto;" />
                                    @endif
                                </td>
                                <td style="max-width:220px;overflow:auto;">{{ $popup->link }}</td>
                                <td>{{ $popup->active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('admin.popup.edit', ['popup_id' => $popup->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('admin.popup.del', ['popup_id' => $popup->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this popup?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No popups found. <a href="{{ route('admin.popup.add') }}">Add one</a>.</div>
            @endif
        </div>
    </div>

@endsection
