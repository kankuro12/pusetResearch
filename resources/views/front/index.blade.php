@extends('front.layout.app')

@section('hideInnerBanner')

@endsection
@section('content')

    @if(View::exists('front.cache.popups'))
        @include('front.cache.popups')
    @endif
    @if(View::exists('front.cache.home'))
        @include('front.cache.home')
    @else
        <div class="text-center py-5">
            <!-- Simple document/launch SVG icon -->
            <svg width="96" height="96" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <rect x="4" y="3" width="16" height="18" rx="2" fill="#E2E8F0" />
                <path d="M8 7h8v2H8zM8 11h8v2H8zM8 15h5v2H8z" fill="#1A202C" />
                <path d="M12 2l2.5 4H9.5L12 2z" fill="#4A5568" />
            </svg>
            <h2 class="mt-4">We don't have a current publication</h2>
            <p>We will be releasing soon.</p>
            <hr>
            <p>
                Please review our <a href="{{ url('/guidelines') }}" class="text-primary font-semibold underline">guidelines and instructions</a> to submit your research.
            </p>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    // Very light popup click handler: when a popup element is clicked, follow its link
    document.addEventListener('click', function(e){
        var el = e.target.closest('.site-popup');
        if(el && el.dataset.link){
            var link = el.dataset.link;
            if(link){ window.open(link, '_blank'); }
        }
    });
</script>
@endpush
