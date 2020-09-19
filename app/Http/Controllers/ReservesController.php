<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Movie;
use App\Reserve;
use App\Ticket;

class ReservesController extends Controller
{   
    /**
     * チケット枚数選択画面を表示するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function showTicketCountForm(Request $request) {
        
        // リクエストにスケジュールIDが設定されていない場合はトップ画面に戻る
		if(!$request->schedule_id){
			return redirect()->action("SchedulesController@index");
		}
		
		// 
        // 上映スケジュール・映画情報取得
        $schedule = Schedule::findOrFail($request->schedule_id);
        $movie = $schedule->movie()->first();

        // セッションにtheater_id、 上映スケジュール情報、 映画情報設定
        $request->session()->put([
            'theater_id' => $request->theater_id, 
            'schedule' => $schedule, 
            'movie' => $movie
        ]);
        
        // レスポンス用にデータを作成
        $data = [
            'schedule' => $schedule,
            'movie' => $movie
        ];

        // 枚数選択画面を表示
        return view('reserves.count', $data);
    }
    
    /**
     * チケット種別選択画面を表示するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function showTicketSelectForm(Request $request) {
        
        // セッションからtheater_id, 上映スケジュール情報, 映画情報取得
        $theater_id = $request->session()->get('theater_id');
        $schedule = $request->session()->get('schedule');
        $movie = $request->session()->get('movie');
        
		//セッションが設定されていない時はトップページに戻る
		if(!$schedule){
			return redirect()->action("SchedulesController@index");
		}        
        
        // 券種取得
        $tickets = Ticket::where('theater_id',$theater_id)->orderBy('id', 'asc')->get();

        // セッションにチケット枚数設定
        $request->session()->put('ticket_count', $request->ticket_count);
        
        // レスポンス用にデータを作成
        $data = [
            'schedule' => $schedule,
            'movie' => $movie,
            'tickets' => $tickets,
            'ticket_count' => $request->ticket_count
        ];

        // 券種選択画面を表示
        return view('reserves.select', $data);

    }
    
    /**
     * 予約確認画面を表示するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function showTicketConfirmForm(Request $request) {
        
        // セッションから上映スケジュール情報、 映画情報、ticket_count取得
        $schedule = $request->session()->get('schedule');
        $movie = $request->session()->get('movie');
        $ticket_count = $request->session()->get('ticket_count');

		//セッションが設定されていない時はトップページに戻る
		if(!$ticket_count){
			return redirect()->action("SchedulesController@index");
		}        
        
        // バリデーションチェック
        switch($ticket_count){
            case 1:
                $request -> validate([
                    'ticket1_id' => 'required',
                ]);
                break;
            case 2:
                $request -> validate([
                    'ticket1_id' => 'required',
                    'ticket2_id' => 'required',
                ]);
                break;
            case 3:
                $request -> validate([
                    'ticket1_id' => 'required',
                    'ticket2_id' => 'required',
                    'ticket3_id' => 'required',
                ]);
                break;
            case 4:
                $request -> validate([
                    'ticket1_id' => 'required',
                    'ticket2_id' => 'required',
                    'ticket3_id' => 'required',
                    'ticket4_id' => 'required',
                ]);
                break;
            case 5:
                $request -> validate([
                    'ticket1_id' => 'required',
                    'ticket2_id' => 'required',
                    'ticket3_id' => 'required',
                    'ticket4_id' => 'required',
                    'ticket5_id' => 'required',
                ]);
                break;
        }
        
        // ログインユーザ情報取得
        $user = \Auth::user();
        
        // セッションにticket_id, total_price設定
        $total_price = 0;
        $request->session()->put('ticket1_id', $request->ticket1_id);
        $tickets = [$request->ticket1_id];
        $total_price = $this->getTicketPrice($total_price, $request->ticket1_id);
        if ($request->ticket2_id) {
            $request->session()->put('ticket2_id', $request->ticket2_id);
            $tickets[] = $request->ticket2_id;
            $total_price = $this->getTicketPrice($total_price, $request->ticket2_id);
        }
        if ($request->ticket3_id) {
            $request->session()->put('ticket3_id', $request->ticket3_id);
            $tickets[] = $request->ticket3_id;
            $total_price = $this->getTicketPrice($total_price, $request->ticket3_id);
        }
        if ($request->ticket4_id) {
            $request->session()->put('ticket4_id', $request->ticket4_id);
            $tickets[] = $request->ticket4_id;
            $total_price = $this->getTicketPrice($total_price, $request->ticket4_id);
        }
        if ($request->ticket5_id) {
            $request->session()->put('ticket5_id', $request->ticket5_id);
            $tickets[] = $request->ticket5_id;
            $total_price = $this->getTicketPrice($total_price, $request->ticket5_id);
        }

        $request->session()->put('total_price', $total_price);

        // 画面表示用に各チケットの枚数を算出
        $tickets_type = [];
        $tickets_count = array_count_values($tickets);
        ksort($tickets_count);
        foreach ($tickets_count as $key => $value) {
            $tickets_type[] = ['name' => Ticket::where('id', $key)->value('ticket_name'), 'count' => $value];
        }
        
        $data = [
            'user'=>$user, 
            'schedule' => $schedule,
            'movie' => $movie,
            'ticket_count' => $ticket_count,
            'tickets_type' => $tickets_type,
            'total_price' => $total_price
        ];
        
        // 確認画面を表示
        return view('reserves.confirm', $data);
    }
    
    /**
     * 予約除法を登録するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function store(Request $request) {
        
        // セッションから予約情報を登録
        $data = $request->user()->reserves()->create([
            'theater_id' => $request->session()->get('theater_id'),
            'movie_id' => $request->session()->get('movie')->id,
            'schedule_id' => $request->session()->get('schedule')->id,
            'ticket_count' => $request->session()->get('ticket_count'),
            'ticket1_id' => $request->session()->get('ticket1_id'),
            'ticket2_id' => $request->session()->get('ticket2_id'),
            'ticket3_id' => $request->session()->get('ticket3_id'),
            'ticket4_id' => $request->session()->get('ticket4_id'),
            'ticket5_id' => $request->session()->get('ticket5_id'),
            'total_price' => $request->session()->get('total_price'),
        ]);
        
        // セッションを削除
        $request->session()->forget("theater_id");
        $request->session()->forget("movie");
        $request->session()->forget("schedule");
        $request->session()->forget("ticket_count");
        $request->session()->forget("ticket1_id");
        $request->session()->forget("ticket2_id");
        $request->session()->forget("ticket3_id");
        $request->session()->forget("ticket4_id");
        $request->session()->forget("ticket5_id");
        $request->session()->forget("total_price");

        // 完了画面を表示
        return view('reserves.complete', ['reserve_id'=> $data->id]);

    }
    
    // チケット金額取得処理
    public function getTicketPrice($total_price, $ticket_id) {
            
            $total_price = $total_price + Ticket::where('id', $ticket_id)->value('ticket_price');
            return $total_price;
    }
    
}
