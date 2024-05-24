<div class="content">
    <div class="about">
        @foreach ($abouts as $about)
         <div class="item">
            <span>
                {{$about->title}}
            </span>
            <div class="description">
                <p>
                    {!! $about->description !!}
                </p>
            </div>
         </div>
        @endforeach
    </div>
</div>
