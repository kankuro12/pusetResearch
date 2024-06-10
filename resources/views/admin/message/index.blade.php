@extends('admin.layout.app')
@section('active','message')
@section('toolbar')
    <a href="{{route('admin.message.add')}}" class="btn btn-primary btn-sm">Add Message</a>
@endsection
@section('header-Links')
<a href="#">Messages</a>
@endsection
@section('content')
    <div class="bg-white mt-3 p-3">

        <table class="table table-bordered" id="message-table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                    <td class="text-start">
                        <img style="max-width:70px;" src="{{asset($message->image)}}"/>
                    </td>
                    <td>{{$message->title}}</td>
                    <td>
                        <a href="{{route('admin.message.edit',['id'=>$message->id])}}" class="text-primary">Edit</a> |
                        <a href="{{route('admin.message.del',['id'=>$message->id])}}" onclick="return yes('Delete Messages')" class="text-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    @include('admin.layout.datatable')
    <script>
        $(document).ready(function () {
            $('#message-table').DataTable({
                columnDefs: [
                    {
                        targets: 2,
                        searchable: false,
                        orderable: false,
                    }
                ]
            });
        });
    </script>


@endsection
