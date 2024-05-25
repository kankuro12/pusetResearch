<div id="sidebar">
    <h5 class="" id="heading">
        {{config('app.title')}}
        <span class="close" onclick="$('#sidebar').removeClass('active')">
            &#10005;
        </span>
    </h5>

    <hr>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="">
                Welcome , <br>{{ $user->name }},
            </a>
            <hr>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="" href="{{ route('index') }}">Visit Website</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="submission" href="{{ route('client.submission.index') }}">My Submissions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile" href="{{ route('client.info.index') }}">My Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pass" href="{{ route('client.info.password') }}">Change Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="" href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</div>
