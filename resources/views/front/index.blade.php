@extends('front.layout.app')

@section('hideInnerBanner')

@endsection
@section('content')
    @includeIf('front.cache.home')
@endsection
