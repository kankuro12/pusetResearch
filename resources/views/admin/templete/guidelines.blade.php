@foreach ($guidelines as $guideline)
    <div class="col-md-12">
        <div class="heading">
            <h2 style="padding: 10px 0px">
                {{ $guideline->title }}
            </h2>
        </div>
        <div class="guidelines">
            {!! $guideline->description !!}
        </div>
    </div>
@endforeach
