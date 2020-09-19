@extends('layouts.app')

@section('content')

    {{-- ナビゲーションタブ表示 --}}
    @include('commons.nav_tabs_create')

    <div class="text-center">
        <h1>上映スケジュール登録</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            {!! Form::model($schedule, ['route'=>'schedules.store']) !!} 
                <div class="form-group row">
                    {!! Form::label('movie_id', '作品', ['class'=>'col-form-label  col-sm-3']) !!}
                    <div class="col-sm-9">
                        {{ Form::select('movie_id', $movies_title->prepend( "作品を選択してください。", ""), null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('screening_date', '上映日', ['class'=>'col-form-label  col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('screening_date', old('screening_date'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('start_time', '上映開始時間', ['class'=>'col-form-label  col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('start_time', old('start_time'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('end_time', '上映終了時間', ['class'=>'col-form-label  col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('end_time', old('end_time'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('reserve_max_count', '最大席数', ['class'=>'col-form-label  col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('reserve_max_count', old('reserve_max_count'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                
                <div class="text-center">
                    {!! Form::submit('スケジュール登録', ['class'=>'btn btn-primary w-50']) !!}
                </div>
            {!! Form::close() !!}
            
            <div class="text-center mt-3">
                {!! link_to_route('schedules.index', 'トップページに戻る', [], ['class'=>'btn btn-light w-50']) !!}
            </div>
        </div>
    </div>
@endsection