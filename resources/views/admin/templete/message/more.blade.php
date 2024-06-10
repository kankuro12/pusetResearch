@if ($messages->count()>0)
    <li class="nav-item dropdown" id="dropdown">
        <a class="nav-link dropdown-toggle" href="#"
            id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            MORE INFO
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @foreach ($messages as $message)
                <li><a class="dropdown-item" href="{{route('message',['slug'=>$message->slug])}}">{{$message->title}}</a></li>
            @endforeach

        </ul>
    </li>
@endif
