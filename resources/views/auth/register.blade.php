@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員情報登録</h1>
    </div>
    <hr>
    
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            {!! Form::open(['route'=>'signup.post']) !!}
                <div class="form-group row">
                    {!! Form::label('name', 'お名前', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', old('name'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('email', 'メールアドレス', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::email('email', old('email'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password', 'パスワード', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password_confirmation', 'パスワード（確認用）', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                    </div>
                </div>

                {!! Form::hidden('admin_flg', '1') !!}
                
                <div class="text-center">
                    {!! Form::submit('会員登録', ['class'=>'btn btn-primary w-50']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection