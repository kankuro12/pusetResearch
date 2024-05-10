<div class="contact">
    <div class="container">
        <h1>
            Contact
        </h1>
        <div class="row m-0">
            <div class="col-md-12 mb-5">
                <div class="main-contact" style="font-size:16px; color: var(--text)" >
                    {{$contact->name}} , {{$contact->address}}
                    <br>
                    P.O.Box {{$contact->po_box}}
                    <br>
                    {{$contact->phone}}
                </div>
            </div>
            @foreach ($individualcontacts as $indcontact)
            <div class="col-md-6">
                <div class="item">
                    <h3>
                        <strong>
                            {{$indcontact->title}}
                        </strong>
                    </h3>
                    <div class="name">
                        {{$indcontact->name}}
                    </div>
                    @if ($indcontact->post == null)

                    @else
                        <div class="post">
                            {{$indcontact->post}}
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
