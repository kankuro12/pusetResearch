@extends('front.layout.app')
@section('header_link')
    @includeif('front.cache.archive_header_link_'.$book_id)
@endsection
@section('top_name')
{{-- {{$book->title}}, {{$book->volume}} --}}
@endsection
@section('meta')
@includeif('front.cache.archive_meta_'.$book_id)
@endsection
@section('content')
@includeif('front.cache.archive_single_'.$book_id)

@endsection
