<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookArtical;
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
            $book->doi = $request->doi;
            $book->website = $request->website;
            $book->language_of_publication = $request->language_of_publication;
            $book->issue = $request->issue;
            $book->published_date = $request->published_date;
            $book->description = $request->description;
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
        Book::where('id', $book_id)->delete();
        return redirect()->back()->with('success', 'succesfully deleted');
    }

    public function indexArtical($book_id)
    {
        $book = Book::where('id', $book_id)->first();
        return view('admin.book.artical.index', compact('book'));
    }
    public function listArtical()
    {
        $articles = BookArtical::select('book_articals.*', 'artical_types.name as artical_type_name', 'book_articals.book_id')
            ->join('artical_types', 'book_articals.artical_type_id', '=', 'artical_types.id')
            ->get();
        // dd($articles);
        return response()->json($articles);
    }
    public function addArtical(Request $request, $book_id)
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
            $artical->abstract = $request->abstract;
            $artical->book_id = $book->id;
            $artical->artical_type_id = $request->artical_type_id;
            $artical->file = $request->file('file')->store('uploads/books/artical');
            $artical->save();
        }
        return redirect()->back()->with('success', 'succesfully added');
    }
    public function editArtical(Request $request,$book_id,$artical_id){
        $book = Book::where('id', $book_id)->first();
        $artical = BookArtical::where('id',$artical_id)->first();
        $articalTypes = DB::table('artical_types')->get();
        if ($request->getMethod() == "GET") {
            return view('admin.book.artical.edit', compact('book','artical','articalTypes'));
        } else {
            $artical->title = $request->title;
            $artical->doi = $request->doi;
            $artical->tags = $request->tags;
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

    public function delArtical($artical_id){
        BookArtical::where('id',$artical_id)->delete();
        return redirect()->back()->with('success', 'succesfully deleted');
    }
}
