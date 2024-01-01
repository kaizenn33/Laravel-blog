<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'detail');
    }
    public function index(){
       $data = Article::latest()->paginate(4);//Object Realtional Mapping
        //Article::all() to select all records
       return view('articles.index', [
        'articles' => $data
       ]);
    }
    //Details
    public function detail($id){
        $article = Article::find($id);
        return view('articles.detail', [
            'article' => $article
        ]   );
    }
    //Delete
    public function delete($id){
        $article = Article::find($id);
        if(Gate::allows('delete-article', $article)){
            $article->delete;
            return redirect("/article")->with("info", "Article Deleted");
        }else{
            return back()->with('info', 'Unauthorized');
        }
    }
    //interfaace to add article
    public function add(){
        $data = Category::all();
        return view('articles.add', [
            "articles" => $data,
        ]);
    }
    //function to add article
    public function create(){

        $validator = validator(request()->all(), [//$request = $POST, validator is helper function to validate the http requests
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);//you can add required in html tags too

        if($validator->fails()){
            return back()->withErrors($validator);
        }//back() is helper function to redirect back

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->save();

        return redirect("/article");
    }
    public function edit($id){
        $data = Article::find($id);
        $data2 = Category::all();
        // $cate = Category::find($id);
        return view('articles.edit', [
            "oldArticle" => $data,
            // "oldCategory" => $cate
            "articles" => $data2
        ]);
    }

    public function update($id){
        $validator = validator(request()->all(), [//$request = $POST, validator is helper function to validate the http requests
            "newTitle" => "required",
            "newContent" => "required",
            "newCategory_id" => "required",
        ]);//you can add required in html tags too

        if($validator->fails()){
            return back()->withErrors($validator);
        }//back() is helper function to redirect back

        $article = Article::find($id);
        $article->title = request()->newTitle;
        $article->body = request()->newContent;
        $article->category_id = request()->newCategory_id;
        $article->save();

        return redirect("/article/detail/$id"); 
    }
}
