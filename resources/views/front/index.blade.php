@extends('front.layout.app')
@section('content')
    <div class="banner">
        <div class="container">
            <div class="books">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bookimage" style="padding: 50px 0px ">
                            <a href="#">
                                <img src="{{ vasset($book->image) }}" alt="book-cover">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
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
        </div>
    </div>
    <div class="article">
        @foreach ($articles as $item)
            <div class="container">
                <div class="editorial">
                    <h5>
                        Editorial
                    </h5>
                </div>
                <hr>
                <div class="data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="head">
                                <div class="authorname">
                                    <i class="fa-regular fa-user"></i> <a href="">Author name</a>
                                </div>
                                <h3>
                                    <a href="">{{$item->title}}</a>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="bottom">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="short_desc">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut minima numquam
                                                consectetur iusto rem sit, laboriosam possimus saepe veniam placeat
                                                similique nemo dicta inventore voluptate eveniet dolor consequuntur nulla
                                                unde?
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <div class="page_no">
                                            {{$item->st_page_no}} - {{$item->en_page_no}}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button>
                                            <i class="fa-regular fa-file-pdf"></i> <a href="{{vasset($item->file)}}">PDF</a>
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
