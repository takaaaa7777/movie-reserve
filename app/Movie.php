<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title','content', 'director', 'cast', 'movie_img'
    ];
    
    /**
     * この作品が登録されているスケジュール。（Scheduleモデルとの関係を定義）
     */
    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    /**
     * この作品が登録されている予約情報。（Reserveモデルとの関係を定義）
     */
    public function reserves() {
        return $this->hasMany(Reserve::class);
    }

}
