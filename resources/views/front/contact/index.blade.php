@extends('front.layout.app')
@section('header_link')
<a href="#">Contact</a>
@endsection
@section('top_name')
Contact
@endsection
@section('content')
@includeif('front.cache.contact');
@endsection
