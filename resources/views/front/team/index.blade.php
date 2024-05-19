@extends('front.layout.app')
@section('content')

    @foreach ($teams as $team)
        <div class="team">
            <div class="container">
                <div class="title">
                    <h5>
                        {{ strtoupper($team->title) }}
                    </h5>
                </div>
                @foreach ($members->where('team_id',$team->id)->values() as $member)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="member">
                                <div class="designation">
                                    <strong>
                                        {{ $member->designation }}
                                    </strong>
                                </div>
                                <div class="name">
                                    {{ $member->name }}
                                </div>
                                <div class="organization">
                                    {{ $member->organization }}
                                </div>
                                <div class="address">
                                    {{ $member->address }}
                                </div>
                                <div class="email">
                                    Email: <a href="mailto:{{$member->mail}}">{{ $member->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    @endforeach
@endsection
