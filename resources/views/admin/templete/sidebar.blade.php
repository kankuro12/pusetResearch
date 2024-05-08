<div class="sidebar-content">
    <p>
        <strong>
            {{ $title->title }}
        </strong>
    </p>
    @foreach ($associates as $item)
        <p>
            <a href="{{ $item->link }}">
                <img src="{{ vasset($item->image) }}" alt="">
            </a>
        </p>
    @endforeach
</div>
