<div class="article-single">
    <div class="container">
        <h1>
            {{ $article->title }}
        </h1>
        <div class="row">
            <div class="col-md-8">
                <div class="info">
                    @foreach ($authors as $_author)
                        <div class="author_name">
                            @php
                                $author = $allAuthors
                                    ->where('id', $_author->author_id)
                                    ->first();
                            @endphp
                            <span class="name">
                                {{ $author->name }}
                            </span>
                            <span class="affiliation">

                                @if(!empty($author->designation))
                                    {{ $author->designation }} <br>
                                @endif
                                @if(!empty($author->organization))
                                {{ $author->organization }} <br>
                                @endif
                                @if(!empty($author->link))
                                    <a href="{{$author->link}}">{{$author->link}}</a>
                                @endif
                            </span>

                        </div>
                    @endforeach
                    <div class="doi">
                        <strong>DOI:</strong>
                        <a href="{{ $article->doi }}">
                            <span class="doi_value">{{ $article->doi }}</span>
                        </a>
                    </div>
                    <div class="tags">
                        <strong>Tags : </strong> {{$article->tags}}
                    </div>
                    <hr>
                    <div class="abstract">
                        <h3>
                            Abstract
                        </h3>
                        @if ($article->abstract == null)
                            <p>
                                N/A
                            </p>
                        @else
                            {{ $article->abstract }}

                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail">
                    <div class="pdf">
                        <a href="{{ vasset($article->file) }}" target="_blank">
                            <i class="fa-regular fa-file-pdf"></i> PDF
                        </a>
                    </div>
                    <div class="published">
                        <div class="heading">
                            Published
                        </div>
                        <div class="value">
                            {{ $book->published_date }}
                        </div>
                    </div>
                    <div class="issue">
                        <div class="item">
                            <div class="heading">
                                Issue
                            </div>
                            <div class="value">
                                <a href="">
                                    {{ $book->issue }}
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="heading">
                                Section
                            </div>
                            <div class="value">
                                {{ $articleType->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
