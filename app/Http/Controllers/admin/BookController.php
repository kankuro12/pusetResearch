<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookArtical;
use App\Models\BookArticalAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('admin.book.index');
    }
    public function list()
    {
        $books = DB::table('books')->get(['id', 'title', 'issn', 'doi', 'published_date', 'issue', 'iscurrent']);
        return response()->json($books);
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == "GET") {
            return view('admin.book.add');
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->eng_title = $request->eng_title;
            $book->issn = $request->issn;
            $book->doi = $request->doi;
            $book->website = $request->website;
            $book->language_of_publication = $request->language_of_publication;
            $book->issue = $request->issue;
            $book->published_date = $request->published_date;
            $book->description = $request->description;
            $book->s_description = $request->s_description;
            $book->title = $request->title;
            $book->image = $request->file('image')->store('upoads/image');
            $book->file = $request->file('file')->store('upoads/file');
            $book->iscurrent =  $request->iscurrent ? true : false;
            $book->save();
        };
        return redirect()->back()->with('success', 'succesfully added');
    }
    public function edit(Request $request, $book_id)
    {
        $book = Book::where('id', $book_id)->first();
        if ($request->getMethod() == "GET") {
            return view('admin.book.edit', compact('book'));
        } else {
            $book->title = $request->title;
            $book->eng_title = $request->eng_title;
            $book->issn = $request->issn;
            $book->doi = $request->doi;
            $book->doi = $request->doi;
            $book->website = $request->website;
            $book->language_of_publication = $request->language_of_publication;
            $book->issue = $request->issue;
            $book->published_date = $request->published_date;
            $book->description = $request->description;
            $book->s_description = $request->s_description;
            $book->title = $request->title;
            if ($request->hasFile('image')) {
                $book->image = $request->file('image')->store('upoads/image');
            }
            if ($request->hasFile('file')) {
                $book->image = $request->file('file')->store('upoads/file');
            }
            $book->iscurrent =  $request->iscurrent ? true : false;

            $book->save();
        }
        return redirect()->back()->with('success', 'Successfully updated');
    }

    public function del($book_id)
    {
        $article = BookArtical::where('book_id', $book_id)->first();

        BookArticalAuthor::where('book_artical_id', $article->id)->delete();
        BookArtical::where('book_id', $book_id)->delete();
        Book::where('id', $book_id)->delete();
        return redirect()->back()->with('success', 'succesfully deleted');
    }

    public function indexArticle($book_id)
    {
        $book = Book::where('id', $book_id)->first();
        return view('admin.book.artical.index', compact('book'));
    }
    public function listArticle()
    {
        $articles = BookArtical::select('book_articals.*', 'artical_types.name as artical_type_name')
            ->join('artical_types', 'book_articals.artical_type_id', '=', 'artical_types.id')
            ->get();
        return response()->json($articles);
    }
    public function addArticle(Request $request, $book_id)
    {
        $book = Book::where('id', $book_id)->first();
        $articalTypes = DB::table('artical_types')->get();
        if ($request->getMethod() == "GET") {
            return view('admin.book.artical.add', compact('book', 'articalTypes'));
        } else {
            $artical = new BookArtical();
            $artical->title = $request->title;
            $artical->doi = $request->doi;
            $artical->tags = $request->tags;
            $artical->st_page_no = $request->starting_page;
            $artical->en_page_no = $request->ending_page;
            $artical->abstract = $request->abstract;
            $artical->book_id = $book->id;
            $artical->artical_type_id = $request->artical_type_id;
            $artical->file = $request->file('file')->store('uploads/books/artical');
            $artical->save();
        }
        return redirect()->back()->with('success', 'succesfully added');
    }
    public function editArticle(Request $request, $book_id, $artical_id)
    {
        $book = Book::where('id', $book_id)->first();
        $artical = BookArtical::where('id', $artical_id)->first();
        $articalTypes = DB::table('artical_types')->get();
        if ($request->getMethod() == "GET") {
            return view('admin.book.artical.edit', compact('book', 'artical', 'articalTypes'));
        } else {
            $artical->title = $request->title;
            $artical->doi = $request->doi;
            $artical->tags = $request->tags;
            $artical->st_page_no = $request->starting_page;
            $artical->en_page_no = $request->ending_page;
            $artical->abstract = $request->abstract;
            $artical->book_id = $book->id;
            $artical->artical_type_id = $request->artical_type_id;
            if ($request->hasFile('file')) {
                $artical->file = $request->file('file')->store('uploads/books/artical');
            }
            $artical->save();
        }
        return redirect()->back()->with('success', 'succesfully updated');
    }

    public function delArticle($artical_id)
    {
        BookArticalAuthor::where('book_artical_id', $artical_id)->delete();
        BookArtical::where('id', $artical_id)->delete();
        return redirect()->back()->with('success', 'succesfully deleted');
    }

    public function listAuthor()
    {
        $authors = DB::table('authors')->get(['id', 'name']);
        return response()->json($authors);
    }

    public function indexAuthor($book_id, $article_id)
    {
        $book = Book::where('id', $book_id)->first();
        $article = BookArtical::where('id', $article_id)->first();
        $authors = BookArticalAuthor::where('book_artical_id', $article_id)->get(['id', 'author_id']);
        return view('admin.book.artical.author.index', compact('article', 'book', 'authors'));
    }

    public function addAuthor(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $authorArticle = new BookArticalAuthor();
            $author_ids = $request->input('author_ids');
            $article_id = $request->input('article_id');
            $book_id = $request->input('book_id');
            foreach ($author_ids as $authorId) {
                $author = Author::where('id', $authorId)->first();
                $authorArticle = new BookArticalAuthor();
                $authorArticle->author_name = $author->name;
                $authorArticle->book_artical_id = $article_id;
                $authorArticle->book_id = $book_id;
                $authorArticle->author_id = $authorId;
                $authorArticle->save();
            }
        }
    }
    public function delAuthor($articleAuthor_id)
    {
        BookArticalAuthor::where('id', $articleAuthor_id)->delete();
        return redirect()->back()->with('success', 'successfully deleted');
    }

    public function saveAuthor($article_id, Request $request)
    {
        $author = new Author();
        $author->name = $request->input('name');
        $author->link = $request->input('link');
        $author->designation = $request->input('designation');
        $author->organization = $request->input('organization');
        $author->save();
        // $authorArticle = new BookArticalAuthor();
        // $authorArticle->author_name = $author->name;
        // $authorArticle->book_artical_id = $article_id;
        // $authorArticle->author_id = $author->id;
        // $authorArticle->save();
    }
}
