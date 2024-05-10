<div class="item">
    <ul>
        <li class="address">
            <i class="fa-solid fa-house"></i>
            <div class="item">
               {{$contact->address}}
            </div>
        </li>
        <li><a href="tel:(+977)98000898">
                <i class="fa-solid fa-phone"></i>
                <div class="item">
                    (+977){{$contact->phone}}
                </div>
            </a>
        </li>
        <li>
            <a href="mailto:test@gamil.com">
                <i class="fa-solid fa-envelope"></i>
                <div class="item">
                    {{$contact->email}}
                </div>
            </a>
        </li>
        <li>
            <a href="">
                More
            </a>
        </li>
    </ul>
</div>
