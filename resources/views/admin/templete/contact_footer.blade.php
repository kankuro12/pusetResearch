{{ $contact->name }} , {{ $contact->address }}
<br>
@if ($contact->po_box != '')
    P.O.Box {{ $contact->po_box }}
    <br>
@endif
@if ($contact->phone != '')
    @foreach (explode(',', $contact->phone) as $phone)
        <a style="display: inline;color:#39628C;font-weight:500;"  href="tel:{{ $phone }}">{{ $phone }}</a>
        @if (!$loop->last)
            ,
        @endif
    @endforeach
    <br>
@endif
@if ($contact->email != '')

    @foreach (explode(',', $contact->email) as $email)
        <a style="display: inline;color:#39628C;font-weight:500;"  href="mailto:{{ $email }}">{{ $email }}</a>
        @if (!$loop->last)
            ,
        @endif
    @endforeach
@endif
