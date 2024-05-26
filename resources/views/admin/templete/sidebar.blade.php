<div class="sidebar-content">
    <p class="heading">
        <strong>
            {{ $title->title }}
        </strong>
    </p>
    <div class="row">
        @foreach ($associates as $item)
            <div class="col-md-12 col-6">
                <p>
                    <a href="{{ $item->link }}">
                        <img src="{{ vasset($item->image) }}" alt="">
                    </a>
                </p>
            </div>
        @endforeach
    </div>
</div>
