<?php

namespace App\Http\Controllers;

use App\Models\ArticalType;
use App\Models\Book;
use App\Models\BookArtical;
use App\Models\BookArticalAuthor;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class FrontController extends Controller
{
    public function index()
    {
        $book = DB::table('books')->where('iscurrent', 1)->first();
        $articles = BookArtical::where('book_id',$book->id)->get();
        return view('front.index', compact('book','articles'));
    }
    public function login(){
        return view('front.login.index');
    }

    public function about(){
        return view('front.aboutus.index');
    }
    public function articleSingle($article_id){
        $article = BookArtical::where('id',$article_id)->first();
        $book = Book::where('id',$article->book_id)->first();
        $articleType = ArticalType::where('id',$article->artical_type_id)->first();
        $authors = BookArticalAuthor::where('book_artical_id',$article->id)->get(['author_name','author_id']);
        return view('front.article.single.index',compact('article','book','articleType','authors'));
    }
    public function policy(){
        return view('front.policy.index');
    }
    public function contact()
    {
        return view('front.contact.index');
    }
    public function register(Request $request)
    {
        if($request->getMethod() == 'GET'){
            return view('front.register.index');
        }else{
            $client = new Client();
            $client->name = $request->name;
            $client->email = $request->email;
            $client->password = $request->password;
            $client->country =$request->country;
            $client->affiliation =$request->affiliation;
            $client->save();
        }
        return redirect()->view('client.index');
    }

    public function submission(){
        return view('front.guidelines.index');
    }
}
