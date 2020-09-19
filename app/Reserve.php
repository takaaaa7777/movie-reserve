<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = [
        'theater_id', 'movie_id', 'schedule_id', 'ticket_count', 'ticket1_id', 'ticket2_id', 'ticket3_id', 'ticket4_id', 'ticket5_id', 'total_price'
    ];
    
    /**
     * この予約情報が登録されているユーザ。（Userモデルとの関係を定義）
     */
    public function user() {
        return $this->belongsTo(User::Class);
    }

    /**
     * この予約情報が登録されている劇場。（Theaterモデルとの関係を定義）
     */
    public function theater() {
        return $this->belongsTo(Theater::Class);
    }

    /**
     * この予約情報が登録されている上映作品。（Movieモデルとの関係を定義）
     */
    public function movie() {
        return $this->belongsTo(Movie::Class);
    }

    /**
     * この予約情報が登録されているスケジュール。（Scheduleモデルとの関係を定義）
     */
    public function schedule() {
        return $this->belongsTo(Schedule::Class);
    }

    /**
     * この予約情報が登録されているチケット。（Ticketモデルとの関係を定義）
     */
    public function ticket() {
        return $this->belongsTo(Ticket::Class);
    }

}
