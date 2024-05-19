@extends('front.layout.app')
@section('header_link')
<a href="{{route('archiveIssue')}}">Issue</a>
@endsection
@section('top_name')
Archives
@endsection
@section('content')
    <div class="archiveIssue">
        <div class="container">
            <div class="heading">
                <h5 style="font-weight: 700 ;color: var(--text); font-size: 22px" >
                    Arcihves
                </h5>
            </div>
            <hr>
            <div class="row">
                @include('front.cache.archive')
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>

</script>
@endsection
