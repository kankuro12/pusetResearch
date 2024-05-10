@extends('front.layout.app')
@section('header_link')
    <a href="{{route('contact')}}">Contact</a>
@endsection
@section('content')
    @include('front.cache.individualcontact')
@endsection
