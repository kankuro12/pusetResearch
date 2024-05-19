@extends('front.layout.app')
@section('content')
    <div class="team">
        <div class="container">
            <div class="title">
                <h5>
                    {{ strtoupper($team->title) }}
                </h5>
            </div>
            @if ($members)
                @foreach ($members as $member)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="member">
                                <div class="designation">
                                    <strong>
                                        {{ $member->designation }}
                                    </strong>
                                </div>
                                <div class="info">
                                    <div class="name">
                                        {{ $member->name }}
                                    </div>
                                    <div class="organization">
                                        {{ $member->organization }}
                                    </div>
                                    <div class="address">
                                        {{ $member->address }}
                                    </div>
                                </div>
                                <div class="email">
                                    Email: {{ $member->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
