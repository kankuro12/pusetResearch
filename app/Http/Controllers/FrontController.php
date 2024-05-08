<?php

namespace App\Http\Controllers;

use App\Models\BookArtical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $book = DB::table('books')->where('iscurrent', 1)->first();
        $articles = BookArtical::where('book_id',$book->id)->get();
        return view('front.index', compact('book','articles'));
    }
    public function login(){
        return view('front.login');
    }

    public function about(){
        return view('front.aboutus.index');
    }
    public function articleSingle($article_id){
        $article = BookArtical::where('id',$article_id)->first();
        return view('front.article.single.index',compact('article'));
    }
}
