<div id="sidebar">
    <div class="ps-3 pt-4 mb-5">

    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" id="dashboard" href="{{ route('admin.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="authors" href="{{ route('admin.author.index')}}">Author</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="book" href="{{ route('admin.book.index')}}">Book</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="team" href="{{ route('admin.team.index')}}">Team</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="guideline" href="{{ route('admin.guideline.index')}}">Guideline</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" id="submission" href="{{ route('admin.submission.index')}}">Submission</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" id="setting" href="{{ route('admin.setting.index')}}">Setting</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="faq" href="{{ route('admin.faq.index')}}">FAQ</a>
        </li>
    </ul>
</div>
