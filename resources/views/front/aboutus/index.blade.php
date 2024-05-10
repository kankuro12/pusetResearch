@extends('front.layout.app')
@section('header_link')
    <a href="{{route('about')}}">About us</a>
@endsection
@section('top_name')
@endsection
@section('content')
@include('front.cache.about')
@endsection
