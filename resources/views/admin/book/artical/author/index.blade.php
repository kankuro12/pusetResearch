@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Book</a>
    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}">Book Article</a>
    <a
        href="{{ route('admin.book.article.articleAuthor.indexAuthor', ['book_id' => $book->id, 'article_id' => $article->id]) }}">Article
        Author</a>
@endsection
<style>
    .select2-container .select2-selection--multiple {
        height: auto !important;
    }
</style>
@section('active', 'book')
@section('content')
    <div class="shadow p-3 bg-white mt-2 rounded">
        <div class="row">
            <div class="col-md-8 mb-2">
                <label for="author" class="mb-2">Select Authors</label>
                <select name="author[]" id="author" multiple="multiple" class="author form-control">
                </select>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" onclick="saveAll()">
                    Add Author
                </button>
            </div>
        </div>
        <div class="row my-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>Author</td>
                        <td>Manage</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $key => $author)
                        <tr>
                            <?php
                            $authorName = DB::table('authors')
                                ->where('id', $author->author_id)
                                ->value('name');
                            ?>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $authorName }}</td>
                            <td><a href="{{ route('admin.book.article.articleAuthor.delAuthor', ['articleAuthor_id' => $author->id]) }}"
                                    class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.author').select2({
                height: 300,
            });
            axios.post("{{ route('admin.book.article.articleAuthor.listAuthor') }}", {
                    name: '',
                    "_token": "{{ csrf_token() }}",
                })
                .then(function(response) {
                    var data = response.data;
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });

                    $('#author').select2({
                        data: results
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching authors:', error);
                });
        });

        function saveAll() {

            var selectedAuthors = $('#author').val();
            var articleId = '{{ $article->id }}';
            axios.post("{{ route('admin.book.article.articleAuthor.addAuthor') }}", {
                    article_id: articleId,
                    author_ids: selectedAuthors,
                    "_token": "{{ csrf_token() }}",
                })
                .then(function(response) {
                    success('successfully added')
                    location.reload();
                })
                .catch(function(error) {
                    console.error('Error saving authors:', error);
                });
        }
    </script>
@endsection
