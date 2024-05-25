<a href="#">Issue</a>
<i class="fa-solid fa-circle"></i>
<a href="{{ route('book.single', ['book_id' => $book->slug??$book->id]) }}">{{ $book->title }} {{ $book->volume }}</a>
<i class="fa-solid fa-circle"></i>
<a href="#">{{ $article->title }} </a>
