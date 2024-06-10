<div id="message">
    <div class="row">

        <div class="col-md-3">
            <img src="{{asset($message->image)}}" class="w-100" alt="">
        </div>
        <div class="col-md-9">
            <h4 id="message-title">{{$message->title}}</h4>
            <p id="message-desc">
                <div>
                    {!! $message->desc !!}
                </div>
            </p>
        </div>
    </div>
</div>
