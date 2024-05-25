@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.faq.index') }}">faq</a>
    <a href="{{ route('admin.faq.add') }}">Add</a>
@endsection
@section('active', 'faq')
@section('content')
    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{route('admin.faq.add')}}" method="post">
            @csrf
            <div class="row mb-2">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="answer">Answer</label>
                    <textarea type="text" name="answer" id="answer" class="form-control note" required></textarea>
                </div>
                <div class="col-md-12 mb-2 text-start">
                    <button class="btn btn-primary btn-sm">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
    @foreach ($faqs as $faq)

    <div class="shadow mt-3 p-3 bg-white rounded">
        <form action="{{route('admin.faq.edit',['faq_id'=>$faq->id])}}" method="post">
            @csrf
            <div class="row mb-2">
                <div class="col-md-12 mb-2">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$faq->title}}" required>
                </div>
                <div class="col-md-12 mb-2">
                    <label for="answer">Answer</label>
                    <textarea type="text" name="answer" id="answer" class="form-control note" required>{{$faq->answer}}</textarea>
                </div>
                <div class="col-md-12 mb-2 text-start">
                    <a href="{{route('admin.faq.del',['faq_id'=>$faq->id])}}" class="btn btn-sm btn-danger">Delete</a>
                    <button class="btn btn-primary btn-sm" >
                        Update
                    </button>

                </div>
            </div>
        </form>
    </div>
    @endforeach



@endsection
@section('js')
    <script>

    </script>
@endsection
