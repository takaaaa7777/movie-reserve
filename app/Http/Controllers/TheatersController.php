<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;

class TheatersController extends Controller
{
    /**
     * 営業時間・アクセス画面を表示するアクション
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */    
    public function show($id) {
        
        // 対象の映画館情報を取得
        $theater = Theater::findOrFail($id);

        // 営業時間・アクセス画面の表示
        return view('theaters.show', ['theater'=>$theater]);
    }
}
