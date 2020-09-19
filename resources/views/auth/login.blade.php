@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ログイン</h1>
    </div>
    <hr>
    
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            {!! Form::open(['route'=>'login.post']) !!}
                <div class="form-group row">
                    {!! Form::label('email', 'メールアドレス', ['class'=>'col-form-label col-sm-3'] ) !!}
                    <div class="col-sm-9">
                        {!! Form::email('email', old('email'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password', 'パスワード', ['class'=>'col-form-label col-sm-3'] ) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password' , ['class'=>'form-control']) !!}
                    </div>
                </div>
                
                <div class="text-center">
                    {!! Form::submit('ログイン', ['class'=>'btn btn-primary w-50']) !!}
                </div>
            {!! Form::close() !!}

            <div class="text-center mt-3 h-50">
                <button onclick="window.location='{{ route("signup.get") }}'" class="'btn btn-light w-50 h-75"> はじめてご利用の方<br>（新規登録）</button>
            </div>
        </div>
    </div>
    
@endsection