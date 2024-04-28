<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(){
        return view('admin.book.index');
    }
    public function list(){
        $books = DB::table('books')->get(['id','title','issn','doi','published_date','issue','iscurrent']);
        return response()->json($books);
    }
    public function add(Request $request){
        if($request->getMethod()=="GET"){
            return view('admin.book.add');
        }else{
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
        return redirect()->back()->with('success' , 'succesfully added');
    }
    public function edit(Request $request, $book_id){
       $book = Book::where('id',$book_id)->first();
        if($request->getMethod()=="GET"){
            return view('admin.book.edit',compact('book'));
        }else{
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
            if($request->hasFile('image')){
                $book->image = $request->file('image')->store('upoads/image');
            }
            if($request->hasFile('file')){
                $book->image = $request->file('file')->store('upoads/file');
            }
            $book->iscurrent =  $request->iscurrent ? true : false;

            $book->save();
        }
        return redirect()->back()->with('success','Successfully updated');
    }

    public function del($book_id){
        Book::where('id',$book_id)->delete();
        return redirect()->back()->with('success' ,'succesfully deleted');
    }
}
