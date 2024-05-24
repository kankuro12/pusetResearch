@php
    $teamCount=$teams->count()-1;
@endphp
@foreach ($teams as $key=>$team)
<div class="team">
    <div class="container">
        <div class="title">
            {{ strtoupper($team->title) }}
        </div>
        <hr class="my-0">
        <div style="overflow: auto">
            {!! $team->desc !!}
        </div>
        {{-- <hr class="my-1"> --}}
        {{-- @php
            $teamMembers=$members->where('team_id',$team->id)->values();
            $memberCount=$teamMembers->count()-1;
        @endphp
        @foreach ($teamMembers as $memberKey => $member)
            <div class="member">
                <div class="designation">
                    <strong>
                        {{ $member->team_designation }}
                    </strong>
                </div>
                <div class="name">
                    {{ $member->name }}
                </div>
                <div class="organization">

                    {{ $member->designation }} <br>
                    {{ $member->organization }}
                </div>
                <div class="address">
                    {{ $member->address }}
                </div>
                <div class="email">
                    Email: <a href="mailto:{{$member->mail}}">{{ $member->email }}</a>
                </div>
            </div>
            @if ( $memberCount!=$memberKey)
                <hr>
            @endif
        @endforeach --}}

    </div>
</div>

@endforeach
