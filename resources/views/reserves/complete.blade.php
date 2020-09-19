@extends('layouts.app')

@section('content')

    @include('reserves.task')
    
    <h5 class="mt-3 font-weight-bold">チケット購入の完了</h5>
    
    <p>チケットの購入が完了しました。<br>予約番号は、入場の際に必要となりますのでお控えください。</p>
    
    <table class="table table-bordered" style="table-layout: fixed;">
        <tbody>
            <tr>
                <th style="width: 30%;">予約番号</th>
                <td style="width: 70%;">{{ $reserve_id }}</td>
            </tr>
        </tbody>    
    </table>

    <div class="text-center mt-3">
        {!! link_to_route('schedules.index', 'トップページに戻る', [], ['class'=>'btn btn-secondary btn-block text-white']) !!}
    </div>
    
@endsection