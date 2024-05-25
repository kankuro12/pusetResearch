<meta property="og:title" content="{{ $article->title }},{{ $book->title }}">
<meta property="og:description" content="{{ $article->abstract }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('articleSingle', ['article' => $article->slug??$article->id]) }}">
<meta property="og:image" content="{{ asset($book->image) }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
