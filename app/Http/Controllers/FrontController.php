<?php

namespace App\Http\Controllers;

use App\Models\ArticalType;
use App\Models\Book;
use App\Models\BookArtical;
use App\Models\BookArticalAuthor;
use App\Models\Client;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class FrontController extends Controller
{
    public function index()
    {
        $book = DB::table('books')->where('iscurrent', 1)->first();
        $articles=[];
        if($book){
            $articles = BookArtical::where('book_id',$book->id)->get();
        }

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
            $request->validate([
                'name'=>'required|string',
                'country'=>'required|string',
                'affiliation'=>'required|string',
                'agree' => 'accepted',
                'email'=>'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->role = 1;
            $user->save();

            $client = new Client();
            $client->user_id = $user->id;
            $client->name = $request->name;
            $client->country =$request->country;
            $client->affiliation =$request->affiliation;
            $client->save();

            Auth::user($user);
            return  redirect()->route('front.login')->with('success','Successfully Registered');
        }
    }

    public function submission(){
        return view('front.guidelines.index');
    }

    public function archiveIssue(){
        return view('front.issue.archive.index');
    }

    public function bookSingle($book_id){
        return view('front.issue.archive.single.index',compact('book_id'));
    }

    public function team(){
        $members = TeamMember::all();
        $teams  = Team::whereIn('id',$members->pluck('id'))->get();
        return view('front.team.index',compact('members','teams'));
    }
}
