@extends('front.layout.app')
@section('content')
<div class="article-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                {{$article->title}}
                </h1>
                <div class="row">
                    <div class="col-md-8">
                        <div class="info">
                            @foreach ($authors as $author)
                            <div class="author_name">
                                <span class="name">
                                    {{$author->author_name}}
                                </span>
                                @php
                                    $author = DB::table('authors')->where('id',$author->author_id)->first();
                                @endphp
                                <span class="affiliation">
                                    {{$author->designation}} <br>
                                    {{$author->organization}}
                                </span>

                            </div>
                            @endforeach
                            <div class="doi">
                                <strong>DOI:</strong>
                                <a href="">
                                    <span class="doi_value">{{$book->doi}}</span>
                                </a>
                            </div>
                            <div class="abstract">
                                <h3>
                                    Abstract
                                </h3>
                                @if ($article->abstract == null)
                                <p>
                                    N/A
                                </p>
                                @else
                                {{$article->abstract}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail">
                            <div class="pdf">
                                <a href="{{asset($article->file)}}">
                                    <i class="fa-regular fa-file-pdf"></i> PDF
                                </a>
                            </div>
                            <div class="published">
                                <div class="heading">
                                    Published
                                </div>
                                <div class="value">
                                    {{$book->published_date}}
                                </div>
                            </div>
                            <div class="issue">
                                <div class="item">
                                    <div class="heading">
                                        Issue
                                    </div>
                                    <div class="value">
                                        <a href="">
                                            {{$book->issue}}
                                        </a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="heading">
                                        Section
                                    </div>
                                    <div class="value">
                                        {{$articleType->name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
