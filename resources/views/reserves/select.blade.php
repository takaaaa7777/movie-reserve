@extends('layouts.app')

@section('content')

    @include('reserves.task')
    
    <h5 class="mt-3 font-weight-bold">チケットの種類をお選びください。</h5>
    
    <div class="row mt-3">
        <div class="col-sm-8">
            {!! Form::open(['route'=>'confirm.show', 'method' => 'get']) !!}
                @for ($i = 1; $i <= $ticket_count; $i++)
                    <div class = "form-group row mb-3 d-flex align-items-center" style="height:80px; border-style: solid; border-width:3px">
                        {!! Form::label("ticket". $i. "_id", $i. "枚目", ['class'=>'col-form-label col-sm-2 text-center  font-weight-bold']) !!}
                        <select name={{ "ticket". $i. "_id" }} class="form-control col-sm-9 text-white" style="background-color:darkgreen">   
                            <option value= "" hidden>券種をお選びください</option>
                            @foreach ($tickets as $ticket)
                                <option value= {{ $ticket->id }} class="bg-white text-dark" >{{ ($ticket->ticket_name). "（" }} &yen; {{ number_format($ticket->ticket_price). "）" }}</option>
                            @endforeach
                        </select>
                    </div>
                @endfor
                
                {!! Form::submit('次へ進む', ['class'=>'btn btn-primary btn-block']) !!}
                <input value="前に戻る" onclick="history.back();" class="btn btn-secondary btn-block text-white mt-3">

            {!! Form::close() !!}
        </div>
            
        <div class="col-sm-4">
            @include('reserves.buy_content')
        </div>
    </div>

    
@endsection