<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;
use App\Schedule;
use Storage;

class MoviesController extends Controller
{
    /**
     * 上映作品一覧画面を表示するアクション
     *
     * @return \Illuminate\Http\Response
     */    
    public function index() {
        
        $movies = Movie::all();
        
        return view('movies.index', ['movies' => $movies]);
        
    }
    
    
    /**
     * 上映作品登録画面を表示するアクション
     *
     * @return \Illuminate\Http\Response
     */    
    public function create() {

        // ユーザに表示権限があるかチェック（なければトップ画面へ）
        if (\Auth::user()->admin_flg == 1) {
            return redirect('/');
        }
        
        $movie = new Movie;
        
        // 上映作品登録画面の表示
        return view('movies.create', [
            'movie'=>$movie
        ]);
    }
    
    /**
     * 上映作品を登録するアクション
     *
     * @return \Illuminate\Http\Response
     */    
    public function store(Request $request) {
        
        // バリデーションチェック
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'director'=>'required|string',
            'cast'=>'required|string',
            'movie_img'=>'required|file|image'
        ]);
        
        $path = Storage::disk('s3')->put('/', $request->file('movie_img'), 'public');

        // 上映作品登録処理
        Movie::create([
            'title' => $request->title,
            'content' => $request->content,
            'director' => $request->director,
            'cast' => $request->cast,
            'movie_img' => Storage::disk('s3')->url($path)
        ]);
        
        // 前のURLへリダイレクトさせる
        return redirect('movies/create')->with('flash_message', '上映作品登録が完了しました。');
    }
}
