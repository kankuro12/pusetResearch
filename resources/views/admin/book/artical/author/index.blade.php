@extends('admin.layout.app')

@section('header-Links')
    <a href="{{ route('admin.book.index') }}">Issues</a>
    <a href="{{ route('admin.book.article.indexArticle', ['book_id' => $book->id]) }}">Articles</a>
    <a
        href="{{ route('admin.book.article.articleAuthor.indexAuthor', ['book_id' => $book->id, 'article_id' => $article->id]) }}">Authors</a>
@endsection

@section('toolbar')
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
        Add New Author
    </button>
@endsection

@section('active', 'book')

@section('content')
    <div class="shadow p-3 bg-white mt-2 rounded">
        <div class="row align-items-end">
            <div class="col-md-8 mb-2">
                <label for="author" class="mb-2">Select Authors</label>
                <select name="author[]" id="author" multiple="multiple" class="author form-control"></select>
            </div>
            <div class="col-md-4 mb-2 d-flex align-items-end">
                <button class="btn btn-primary btn-sm" onclick="saveAll()">Add Author</button>
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

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            data-whatever="@mdo">Open modal for @mdo</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </div>
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
            if (!selectedAuthors || selectedAuthors.length === 0) {
                error('Please select at least one Author');
                return;
            }

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


        function saveNewAuthor() {
            var name = $('#author-name').val();
            var link = $('#author-link').val();
            var designation = $('#author-designation').val();
            var organization = $('#author-organization').val();

            const data = {
                name: name,
                link: link,
                designation: designation,
                organization: organization,
                "_token": "{{ csrf_token() }}"
            };

            var articleId = '{{ $article->id }}';
            var bookId = '{{ $book->id }}';

            const url =
                `{{ route('admin.book.article.articleAuthor.saveAuthor', ['book_id' => ':book', 'article_id' => ':article']) }}`
                .replace(':book', bookId)
                .replace(':article', articleId);

            axios.post(url, data)
                .then(res => {
                    alert('Author successfully added');
                    location.reload();
                })
                .catch(err => {
                    console.error('Error adding author:', err);
                });
        }
    </script>
@endsection
