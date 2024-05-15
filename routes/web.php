<?php

use App\Http\Controllers\admin\AuthorController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\FileController;
use App\Http\Controllers\admin\GuidelineController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SubmissionController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\TeamMemberController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\DashbordController as ClientDashbordController;
use App\Http\Controllers\client\SubmissionController as ClientSubmissionController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


// DB::table('users')->insert([
//     'name' => 'komalstha',
//     'email' => 'komal@gmail.com',
//     'password' => bcrypt('password'),
//      'role' => '0',
// ]);
Route::get('/',[FrontController::class,'index'])->name('index');
Route::get('layout',[FrontController::class,'layout'])->name('layout');
Route::get('frontlogin',[FrontController::class,'login'])->name('frontlogin');
Route::get('about',[FrontController::class,'about'])->name('about');
Route::get('policy',[FrontController::class,'policy'])->name('policy');
Route::get('contact',[FrontController::class,'contact'])->name('contact');
Route::get('submission',[FrontController::class,'submission'])->name('submission');
Route::match(['GET','POST'],'register',[FrontController::class,'register'])->name('register');
Route::get('articleSingle/{article}',[FrontController::class,'articleSingle'])->name('articleSingle');

Route::match(['GET', 'POST'], 'login', [LoginController::class, 'login'])->name('login');
Route::match(['POST'],'clientlogin',[LoginController::class,'clientlogin'])->name('clientlogin');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashbordController::class, 'index'])->name('index');
    Route::get('/file', [FileController::class, 'index'])->name('file');

    Route::prefix('author')->name('author.')->group(function () {
        Route::get('index', [AuthorController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [AuthorController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{author_id}', [AuthorController::class, 'edit'])->name('edit');
        Route::get('del/{author_id}', [AuthorController::class, 'del'])->name('del');
        Route::get('list', [AuthorController::class, 'list'])->name('list');
    });
    Route::prefix('book')->name('book.')->group(function () {
        Route::get('index', [BookController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [BookController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{book_id}', [BookController::class, 'edit'])->name('edit');
        Route::get('del/{book_id}', [BookController::class, 'del'])->name('del');
        Route::get('list', [BookController::class, 'list'])->name('list');
        Route::prefix('article')->name('article.')->group(function () {
            Route::get('indexArticle/{book_id}', [BookController::class, 'indexArticle'])->name('indexArticle');
            Route::match(['GET', 'POST'], 'addArticle/{book_id}', [BookController::class, 'addArticle'])->name('addArticle');
            Route::match(['GET', 'POST'], 'editArticle/{book_id}/{article_id}', [BookController::class, 'editArticle'])->name('editArticle');
            Route::get('delArticle/{article_id}', [BookController::class, 'delArticle'])->name('delArticle');
            Route::get('listArticle', [BookController::class, 'listArticle'])->name('listArticle');
            Route::prefix('articleAuthor')->name('articleAuthor.')->group(function () {
                Route::post('listAuthor', [BookController::class, 'listAuthor'])->name('listAuthor');
                Route::get('indexAuthor/{book_id}/{article_id}', [BookController::class, 'indexAuthor'])->name('indexAuthor');
                Route::match(['POST'], 'addAuthor', [BookController::class, 'addAuthor'])->name('addAuthor');
                Route::get('delAuthor/{articleAuthor_id}', [BookController::class, 'delAuthor'])->name('delAuthor');
                Route::post('saveAuthor/{book_id}/{article_id}',[BookController::class,'saveAuthor'])->name('saveAuthor');
            });
        });
    });
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('index', [TeamController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [TeamController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{team_id}', [TeamController::class, 'edit'])->name('edit');
        Route::get('del/{team_id}', [TeamController::class, 'del'])->name('del');
        Route::get('list', [TeamController::class, 'list'])->name('list');
        Route::prefix('team_member')->name('team_member.')->group(function () {
            Route::get('index/{team_id}', [TeamMemberController::class, 'index'])->name('index');
            Route::match(['GET', 'POST'], 'add/{team_id}', [TeamMemberController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], 'edit/{team_id}/{team_member_id}', [TeamMemberController::class, 'edit'])->name('edit');
            Route::get('del/{team_member_id}', [TeamMemberController::class, 'del'])->name('del');
            Route::get('list/{team_id}', [TeamMemberController::class, 'list'])->name('list');
        });
    });
    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('index', [SubmissionController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [SubmissionController::class, 'add'])->name('add');
        Route::match(['get'], 'edit/{sub_id}', [SubmissionController::class, 'edit'])->name('edit');
        Route::get('del/{sub_id}', [SubmissionController::class, 'del'])->name('del');
        Route::get('list', [SubmissionController::class, 'list'])->name('list');
    });
    Route::prefix('guideline')->name('guideline.')->group(function () {
        Route::get('index', [GuidelineController::class, 'index'])->name('index');
        Route::match(['GET', 'POST'], 'add', [GuidelineController::class, 'add'])->name('add');
        Route::match(['GET', 'POST'], 'edit/{guideline_id}', [GuidelineController::class, 'edit'])->name('edit');
        Route::get('del/{guideline_id}', [GuidelineController::class, 'del'])->name('del');
        Route::get('list', [GuidelineController::class, 'list'])->name('list');
    });
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('index', [FaqController::class, 'index'])->name('index');
        Route::match(['POST'], 'add', [FaqController::class, 'add'])->name('add');
        Route::match(['POST'], 'edit/{faq_id}', [FaqController::class, 'edit'])->name('edit');
        Route::get('del/{faq_id}', [FaqController::class, 'del'])->name('del');
    });
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('index', [SettingController::class, 'index'])->name('index');

        Route::prefix('generalLayout')->name('generalLayout.')->group(function(){
            Route::match(['GET','POST'],'general_index',[SettingController::class,'general_index'])->name('general_index');
        });
        Route::prefix('policy')->name('policy.')->group(function () {
            Route::get('policy_index', [SettingController::class, 'policy_index'])->name('policy_index');
            Route::match(['POST'], 'policy_add', [SettingController::class, 'policy_add'])->name('policy_add');
            Route::match(['POST'], 'policy_edit/{policy_id}', [SettingController::class, 'policy_edit'])->name('policy_edit');
            Route::get('policy_del/{policy_id}', [SettingController::class, 'policy_del'])->name('policy_del');
        });
        Route::prefix('about')->name('about.')->group(function () {
            Route::get('about_index', [SettingController::class, 'about_index'])->name('about_index');
            Route::match(['POST'], 'about_add', [SettingController::class, 'about_add'])->name('about_add');
            Route::match(['GET','POST'], 'about_edit/{about_id}', [SettingController::class, 'about_edit'])->name('about_edit');
            Route::get('about_del/{about_id}', [SettingController::class, 'about_del'])->name('about_del');
        });
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::match(['GET', 'POST'], 'index', [ContactController::class, 'index'])->name('index');
            Route::get('del/{contact_id}', [ContactController::class, 'del'])->name('del');
        });
        Route::prefix('article_type')->name('artical_type.')->group(function () {
            Route::get('indexArtical', [SettingController::class, 'indexArtical'])->name('indexArtical');
            Route::match(['post'], 'addArtical', [SettingController::class, 'addArtical'])->name('addArtical');
            Route::match(['post'], 'editArtical/{artical_id}', [SettingController::class, 'editArtical'])->name('editArtical');
            Route::get('delArtical/{artical_id}', [SettingController::class, 'delArtical'])->name('delArtical');
        });
        Route::prefix('associate')->name('associate.')->group(function(){
            Route::match(['GET','POST'],'indexAsso',[SettingController::class,'indexAsso'])->name('indexAsso');
            Route::match(["POST"],'addAsso',[SettingController::class,'addAsso'])->name('addAsso');
            Route::match(["POST"],'editAsso',[SettingController::class,'editAsso'])->name('editAsso');
            Route::match(["GET"],'delAsso/{asso_id}',[SettingController::class,'delAsso'])->name('delAsso');
        });
    });
});

Route::prefix('client')->name('client.')->group(function(){
    Route::get('index',[ClientController::class,'index'])->name('index');
    Route::prefix('submission')->name('submission.')->group(function(){
        Route::get('index',[ClientSubmissionController::class,'index'])->name('index');
        Route::match(['GET','POST'],'add',[ClientSubmissionController::class,'add'])->name('add');
        Route::match(['GET','POST'],'edit/{sub_id}',[ClientSubmissionController::class,'edit'])->name('edit');
        Route::match(['GET'],'del/{sub_id}',[ClientSubmissionController::class,'del'])->name('del');
        Route::get('list',[ClientSubmissionController::class,'list'])->name('list');
    });
});
