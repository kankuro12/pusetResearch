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
                <button class="btn btn-primary btn-sm" onclick="saveAll()">
                    Add Author
                </button>
            </div>
        </div>
        <div class="row my-2 p-2">
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
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $authorName }}</td>
                            <td><a href="{{ route('admin.book.article.articleAuthor.delAuthor', ['articleAuthor_id' => $author->id]) }}"
                                    class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2 p-2 shadow">
            <div class="heading text-start mb-2">
                <button class="btn btn-primary btn-sm" onclick="render()">
                    Add New Author
                </button>
            </div>
            <div id="authorAdd" class="row ">

            </div>
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
            var bookId = '{{ $book->id }}';
            axios.post("{{ route('admin.book.article.articleAuthor.addAuthor') }}", {
                    article_id: articleId,
                    author_ids: selectedAuthors,
                    book_id: bookId,
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

        function render() {
            $('#authorAdd').append(`
                <div class="col-md-4 mb-2">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="designation">Designation</label>
                    <input type="text" name="designation" id="designation" class="form-control">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="organization">Organization</label>
                    <input type="text" name="organization" id="organization" class="form-control">
                </div>
                <div class="col-md-12 mb-2 text-start">
                    <button class="btn btn-primary btn-sm" onclick ="saveAuthor('{{ $article->id }}','{{ $book->id }}')">
                        Add
                    </button>
                </div>`)
        }

        function saveAuthor(article_id, book_id) {
            var name = $('#name').val();
            var link = $('#link').val();
            var designation = $('#designation').val();
            var organization = $('#organization').val();

            const data = {
                name: name,
                link: link,
                designation: designation,
                organization: organization,
            }

            console.log(data);
            const url =
                `{{ route('admin.book.article.articleAuthor.saveAuthor', ['book_id' => ':book', 'article_id' => ':article']) }}`
                .replace(':book', book_id)
                .replace(':article', article_id);
            axios.post(url, data)
                .then(res => {
                    success('successfully added');
                    location.reload();
                })
                .catch(err => {
                    console.error(err);
                })
        }
    </script>
@endsection
