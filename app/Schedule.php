<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'screening_date','start_time', 'end_time', 'reserve_max_count'
    ];

    /**
     * このスケジュールに登録されている上映作品。（Movieモデルとの関係を定義）
     */
    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    /**
     * このスケジュールが登録している予約情報。（Reserveモデルとの関係を定義）
     */
    public function reserves() {
        return $this->hasMany(Reserve::class);
    }

    /**
     * このスケジュールに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('reserves');
    }    
}
