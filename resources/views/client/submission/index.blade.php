@extends('client.layout.app')
@section('header-link')
    <a href="{{route('client.submission.index')}}">Submission</a>
@endsection
@section('toolbar')
    <a href="{{route('client.submission.add')}}" class="btn btn-sm btn-primary">Add</a>
@endsection
