@extends('layouts.app')

@section('content')

    @include('reserves.task')
    
    <h5 class="mt-3 font-weight-bold">購入内容をご確認ください。</h5>
    
    <div class="card">
        <div class="card-header bg-dark text-white text-center">
            <h5>お客様情報</h5>
        </div>
        <div class="card-body">
            <p class="mb-0">お名前</p>
            <p class="mt-0">{{ $user->name }}</p>
            <p class="mb-0">メールアドレス</p>
            <p class="mt-0 mb-0">{{ $user->email }}</p>
        </div>
    </div>
    
    <div class="mt-3">
        @include('reserves.buy_content')
    </div>
        {!! Form::open(['route' => 'reserves.store']) !!}
            {!! Form::submit('上記の内容で、予約する', ['class' => 'btn btn-primary btn-block mt-3']) !!}
            <input value="前に戻る" onclick="history.back();" class="btn btn-secondary btn-block text-white mt-3">
        {!! Form::close() !!}
@endsection