<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_name','ticket_price'
    ];

    /**
     * このチケットが登録されている劇場。（Theaterモデルとの関係を定義）
     */
    public function theater() {
        return $this->belongsTo(Theater::class);
    }

    /**
     * このチケットが登録されている予約情報。（Reserveモデルとの関係を定義）
     */
    public function reserves() {
        return $this->hasMany(Reserve::class);
    }
    
}
