@if ($books->count() > 0)
    @php
        $len=$books->count()-1;
    @endphp
    @foreach ($books as $key=>$book)
    <div class="archive">
        <div class="row">
            <div class="col-md-2">
                <img src="{{vasset($book->image)}}" alt="{{$book->volume}}">
            </div>
            <div class="col-md-9">
                <a href="{{ route('book.single', ['book_id' => $book->slug??$book->id]) }}">
                    <div class="name">
                        {{ $book->title }}, {{ $book->volume }}
                    </div>
                    <div class="date">
                        Issued {{ $book->issue }}
                    </div>
                    <div class="desc">
                        {{ $book->s_description }}
                    </div>
                </a>
                @php
                    $articles=$bookArticles->where('book_id',$book->id);
                    $alen=$articles->count()
                @endphp

                @if ($alen>0)
                    <div class="chapters">
                        @foreach ($articles as $akey=>$article)
                            <a href="{{route('articleSingle',['article'=>($article->slug??$article->id)])}}">{{$article->title}}</a> @if(($alen-1)>$akey), @endif
                        @endforeach
                    </div>

                @endif
            </div>
        </div>

    </div>
    @if ($len>$key)
    <hr>
    @endif

    @endforeach
@else
    <h5>The journal doesn't have older issues.</h5>
@endif
