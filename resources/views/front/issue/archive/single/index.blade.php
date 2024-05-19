@extends('front.layout.app')
@section('header_link')
    <a href="{{ route('archiveIssue') }}">Issue</a>
    <i class="fa-solid fa-circle"></i>
    <a href="#">{{ $book->title }}</a>
@endsection
@section('top_name')
Archive
@endsection
@section('content')
    <div class="archiveSingle">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="bookimage" style="padding: 50px 0px ">
                        <a href="#">
                            <img src="{{ asset($book->image) }}" alt="book-cover">
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="banner">
                        <h1 style="color: var(--text)">
                            {{ $book->title }}
                        </h1>
                        <div class="description">
                            {{ $book->s_description }} <a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($articles as $item)
            @php
                $authors = DB::table('book_artical_authors')
                    ->where('book_artical_id', $item->id)
                    ->get();
            @endphp
            <div class="container_b p-0">
                <div class="editorial">
                    <h5>
                        {{$item->article_type}}
                    </h5>
                </div>
                <hr>
                <div class="data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="head">
                                <div class="authorname">
                                    <i class="fa-regular fa-user"></i>
                                    @foreach ($authors as $author)
                                        <a href="">{{ $author->author_name }} </a>
                                    @endforeach
                                </div>
                                <h3>
                                    <a href="{{ route('articleSingle', ['article' => $item->id]) }}">{{ $item->title }}</a>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="bottom">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="short_desc">
                                            <p>
                                           {{$item->abstract}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <div class="page_no">
                                            {{ $item->st_page_no }} - {{ $item->en_page_no }}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button>
                                            <i class="fa-regular fa-file-pdf"></i> <a
                                                href="{{ vasset($item->file) }}">PDF</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
