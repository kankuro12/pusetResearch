<div class="row">
    @foreach ($policies as $policy)
        <div class="col-md-12 mb-3">
            <div class="title mb-3" style="font-size: 18px">
                <strong>
                    {{ $policy->title }}
                </strong>
            </div>
            <div class="description" style="font-size: 18px;text-align: justify;">
                {{ $policy->description }}
            </div>
        </div>
    @endforeach
</div>
