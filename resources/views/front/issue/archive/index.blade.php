@extends('front.layout.app')
@section('header_link')
<a href="{{route('archive')}}">Archive</a>
@endsection
@section('top_name')
Archive
@endsection
@section('content')
    <div class="archiveIssue">
        @if(View::exists('front.cache.archive'))
            @includeIf('front.cache.archive')
        @else
            <h5>The journal doesn't have older issues.</h5>
        @endif
    </div>
@endsection
@section('js')
<script>

</script>
@endsection
