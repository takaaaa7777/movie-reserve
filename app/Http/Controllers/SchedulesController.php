<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;
use App\Movie;

class SchedulesController extends Controller
{
    
    /**
     * 上映スケジュール一覧画面を表示するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function index(Request $request) {
        
        $data = [];
        
        // 日付を取得
        if ($request->date) {
            $target_date = $request->date;
        } else {
            $target_date = date('Y/m/d');
        }
        
        // レスポンス用データを作成        
        $data = [
            'target_date' => $target_date,
            'target_week' => $this->getWeek(),
            'movie_schedules' => $this->getMovieSchedule($target_date)
        ];
        
        return view('schedules.index', $data);
    }
        
    /**
     * 上映スケジュール登録画面を表示するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function create() {

        // ユーザに表示権限があるかチェック（なければトップ画面へ）
        if (\Auth::user()->admin_flg == 1) {
            return redirect('/');
        }

        $schedule = new Schedule;

        $data = [];

        // 上映作品一覧を取得
        $movies = Movie::select('id', 'title')->get();

        // key,value ペアに直す
        $movies_title = $movies->pluck("title", "id");
        
        // 上映作品スケジュール登録画面の表示
        return view('schedules.create', ['schedule'=>$schedule, 'movies_title'=>$movies_title]);
    }
    
    /**
     * 上映スケジュールを登録するアクション
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */    
    public function store(Request $request) {

        // バリデーションチェック
        $request -> validate([
            'movie_id' => 'required',
            'screening_date' => 'required|date_format:Y/m/d',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'reserve_max_count' => 'required|integer',
        ]);
        
        // idで上映作品情報を取得
        $movie = Movie::findOrFail($request->movie_id);

        // 上映スケジュール情報の登録
        $movie->schedules()->create([
            'screening_date'=>$request->screening_date,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'reserve_max_count'=>$request->reserve_max_count
        ]);
        
        // 上映スケジュール登録画面へ戻る
        return redirect('schedules/create') -> with('flash_message', '上映スケジュール登録が完了しました。');
    }
    
    // 映画スケジュール取得処理
    public function getMovieSchedule($target_date) {

        // 映画スケジュール取得
        $shcdules = Schedule::where('screening_date', $target_date) -> orderByRaw('movie_id asc, start_time asc') -> get();
        
        $pre_movie_id = 0;
        $movie_shcedules = [];
        $schedule_list= [];

        // 映画スケジュールを画面表示用にmovie_idごとに格納しなおす      
        foreach ($shcdules as $schedule) {
            
            // 前レコードとmovie_idが変わった場合
            if ($pre_movie_id != $schedule->movie_id) {
                
                // schedule_listにデータが格納されている場合、表示用の配列に格納
                if ($schedule_list) {
                    $movie_shcedules[] = [
                        'title' => $title,
                        'schedule_list' => $schedule_list
                    ];
                } 
                
                // 上映タイトル取得
                $title = $schedule->movie->title;
                
                // 初期化処理
                $schedule_list = [$schedule];
                $pre_movie_id = $schedule->movie_id;
                
            } else {
                $schedule_list[] = $schedule;
            }
        }

        // 最終レコードを表示用の配列に格納
        if ($schedule_list) {
            $movie_shcedules[] = [
                'title' => $title,
                'schedule_list' => $schedule_list
            ];
        } 
        return $movie_shcedules;
    }
    
    // 1週間分の日付取得処理
    public function getWeek() {

        for ($i = 0; $i < 6; $i++) {
            $target_week[] = date('Y/m/d', strtotime('+'. $i. 'day', time()));
        }
        
        return $target_week;
    }

}
