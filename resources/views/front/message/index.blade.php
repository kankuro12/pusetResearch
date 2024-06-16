@extends('front.layout.app')
@section('header_link')
@includeIf('front.cache.message_title_'.$filename)
@endsection
@section('content')
@includeIf('front.cache.message_'.$filename)
@endsection
