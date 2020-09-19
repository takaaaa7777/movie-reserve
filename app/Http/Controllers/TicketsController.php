<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;
use App\Ticket;

class TicketsController extends Controller
{
    /**
     * チケット料金画面を表示するアクション
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */    
    public function show($id) {
        
        // 対象の映画館情報取得
        $theater = Theater::findOrFail($id);
        // 映画館のチケット情報取得
        $tickets = $theater->tickets()->get();
        //チケット料金画面を表示
        return view('tickets.show', ['tickets' => $tickets]);
    }
}
