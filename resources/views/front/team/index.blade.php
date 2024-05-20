@extends('front.layout.app')
@section('header_link')
<a href="{{route('team')}}">Team</a>
@endsection
@section('content')
    @includeif('front.cache.team')
@endsection
