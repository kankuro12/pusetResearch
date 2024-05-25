<div class="accordion" id="accordionFaq">
    @foreach ($faqs as $key=>$faq)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button {{$key==0?'':'collapsed'}}" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{$key==0?'true':'false'}}"
                    aria-controls="collapse-{{ $faq->id }}">
                    <strong>
                        {{ $faq->title }}
                    </strong>
                </button>
            </h2>
            <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{$key==0?'show':''}}" data-bs-parent="#accordionFaq">
                <div class="accordion-body">
                    {!! $faq->answer !!}
                </div>
            </div>
        </div>
    @endforeach

</div>
