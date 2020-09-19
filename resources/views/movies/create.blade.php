@extends('layouts.app')

@section('content')

    {{-- ナビゲーションタブ表示 --}}
    @include('commons.nav_tabs_create')

    <div class="text-center">
        <h1>上映作品登録</h1>
    </div>
    <hr>
    
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    {!! Form::label('title', 'タイトル', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('title', old('title'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('content', '内容', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('content', old('content'), ['class'=>'form-control', 'rows' => 5]) !!} 
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('director', '監督', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('director', old('director'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('cast', 'キャスト', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('cast', old('cast'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('movie_img', '作品イメージ', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::file('movie_img', old('movie-img'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="text-center">
                    {!! Form::submit('作品登録', ['class'=>'btn btn-primary w-50']) !!}
                </div>
            </form>

            <div class="text-center mt-3">
                {!! link_to_route('movies.index','トップページに戻る', [], ['class'=>'btn btn-light w-50']) !!}
            </div>
        </div>
    </div>

@endsection