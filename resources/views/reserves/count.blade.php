@extends('layouts.app')

@section('content')

    @include('reserves.task')
    
    <h5 class="mt-3 font-weight-bold">チケットの枚数をお選びください。</h5>
    
    <div class="row ml-3 mt-3">
        <div class="col-sm-8">
            {!! Form::open(['route' => 'select.show', 'method' => 'get']) !!}
                <div class="form-group row">
                    {!! Form::label('ticket_count', 'チケット枚数', ['class'=>'col-form-label col-sm-3']) !!}
                    <div class="col-sm-3">
                        {!! Form::select('ticket_count', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'], 1, ['class'=>'form-control']) !!}
                    </div>
                </div>
                
                <div style="margin-top: 123px;">
                    {!! Form::submit('次へ進む', ['class'=>'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}
            
            <div class="text-center mt-3">
                {!! link_to_route('schedules.index', 'トップページに戻る', [], ['class'=>'btn btn-secondary btn-block text-white']) !!}
            </div>
        </div>
        
        <div class="col-sm-4">
            @include('reserves.buy_content')
        </div>
    </div>

    
@endsection