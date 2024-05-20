@extends('front.layout.app')
@section('header_link')
    @includeIf('front.cache.article_header_' . $article_id)
@endsection
@section('top_name')
    @includeIf('front.cache.article_title_' . $article_id)
@endsection
@section('title')
    @includeIf('front.cache.article_title_' . $article_id)
@endsection
@section('meta')
    @includeIf('front.cache.article_meta_' . $article_id)
@endsection
@section('content')
    @includeIf('front.cache.article_index_' . $article_id)
@endsection
