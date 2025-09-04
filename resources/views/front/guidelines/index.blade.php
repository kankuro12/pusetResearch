@extends('front.layout.app')

@section('top_name')
    Guidelines
@endsection
@section('header_link')
    <a href="{{ route('submission') }}">GuideLines</a>
@endsection
@section('content')
    <div class="submission">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-12 mb-4">
                    <h1>
                        Submisson
                    </h1>
                    <div class="submission-view">
                        <a href="#">
                            Make a new Submission
                        </a>
                        or
                        <a href="#">
                            view pending submission
                        </a>
                    </div>
                </div> --}}
                @includeIf('front.cache.guidelines')
            </div>
        </div>
    </div>
@endsection
