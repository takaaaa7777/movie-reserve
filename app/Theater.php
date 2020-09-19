<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = [
        'theater_name','open_time', 'close_time', 'address', 'parking_count', 'tel_number', 'access'
    ];

    /**
     * この劇場に登録されているチケット。（Ticketモデルとの関係を定義）
     */
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    /**
     * この劇場に登録されている予約情報。（Reserveモデルとの関係を定義）
     */
    public function reserves() {
        return $this->hasMany(Reserve::class);
    }
    
}
