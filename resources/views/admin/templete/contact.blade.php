<div class="contact">
    <div class="container">
        <h1>
            Contact Us
        </h1>
        <div class="row m-0">
            <div class="col-md-12 mb-5">
                <div class="main-contact" style="font-size:16px; color: var(--text)">
                    {{ $contact->name }} , {{ $contact->address }}
                    <br>
                    @if ($contact->po_box != '')
                        P.O.Box {{ $contact->po_box }}
                        <br>
                    @endif
                    @if ($contact->phone != '')

                        @foreach (explode(',', $contact->phone) as $phone)
                            <a href="tel:{{ $phone }}">{{ $phone }}</a>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                        <br>
                    @endif
                    @if ($contact->email != '')

                        @foreach (explode(',', $contact->email) as $email)
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            @foreach ($individualcontacts as $indcontact)
                <div class="col-md-6">
                    <div class="item">
                        <h3>
                            <strong>
                                {{ $indcontact->post }}
                            </strong>
                        </h3>
                        <div class="name">
                            {{ $indcontact->name }}
                        </div>

                        <div class="phone">

                            @foreach (explode(',', $indcontact->phone) as $phone)
                                <a href="tel:{{ $phone }}">{{ $phone }}</a>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach

                        </div>

                        <div class="email">
                            @foreach (explode(',', $indcontact->email) as $email)
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
