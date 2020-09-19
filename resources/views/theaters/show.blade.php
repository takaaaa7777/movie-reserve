@extends('layouts.app')

@section('content')
    
    {{-- ナビゲーションタブ表示 --}}
    @include('commons.nav_tabs')
    
    <h4>営業時間</h4>
    <div class="ml-3">
        <p>{{ ltrim(date('H:i',  strtotime($theater->open_time)), 0). "～". ltrim(date('H:i',  strtotime($theater->close_time)), 0) }}</p>
    </div>
    
    <h4>アクセス</h4>
    <div class="ml-3">
        <div class="row">
            <div class="col-sm-2">
                <p>住所</p>
            </div>
            <div class="col-sm-10">
                <p class="mb-0">{{ '：〒'. $theater->post_code }}</p>
                <p class="mt-0 ml-3">{{ $theater->address }}</p>
            </div>
            <div class="col-sm-2">
                <p>駐車場</p>
            </div>
            <div class="col-sm-10">
                <p class="mb-0">{{ '：'. $theater->parking_count. '台' }}</p>
            </div>
            <div class="col-sm-2">
                <p>電話番号</p>
            </div>
            <div class="col-sm-10">
                <p class="mb-0">{{ '：'. $theater->tel_number }}</p>
            </div>
            <p class="ml-1">{{ '・'. $theater->access }}</p>
        </div>
    </div>

@endsection