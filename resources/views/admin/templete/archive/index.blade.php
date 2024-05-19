@foreach ($books as $book)
    <div class="col-md-12">
        <div class="content">
            <a href="{{ route('archiveIssue.single', ['book_id' => $book->id]) }}">{{ $book->title }} <div class="date"> {{ $book->issue }}</div> </a>
            <p>{{ $book->volume }}</p>
        </div>
        <hr>
    </div>
@endforeach
