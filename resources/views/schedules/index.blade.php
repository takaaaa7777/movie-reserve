@extends('layouts.app')

@section('content')
    
    {{-- ナビゲーションタブ表示 --}}
    @include('commons.nav_tabs')

    <img src="{{ asset('/assets/images/pic_screen.jpg') }}" alt="映画館イメージ" class="img-fluid w-100 mb-3">
    
    <div class="text-center bg-dark text-white">
        <h1>上映スケジュール</h1>
    </div>
    
    <ul class="nav nav_tabs nav-justified mt-3">
        @foreach ($target_week as $date)
            <li class="nav-item border">
                {!! Form::open(['route'=>'schedules.index', 'method' => 'get']) !!}
                    {{ Form::hidden('date', $date) }}
                    {!! Form::submit(date('n月d日',  strtotime($date)), ['class'=>'btn btn-light btn-block']) !!} 
                {!! Form::close() !!}
            </li>
        @endforeach
    </ul>
    
    <h2 class="text-danger mt-3">{{ date('n月d日',  strtotime($target_date)) }}</h2>

    @foreach ($movie_schedules as $movie_schedule)
        <div class = "card mt-3">
            <div class="card-header bg-dark text-white">
                {{ $movie_schedule['title'] }}
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    @foreach ($movie_schedule['schedule_list'] as $schedule)
                    
                        <div class="card mr-3">
                            <div class="card-body">
                                <h5>{{ date('H:i',  strtotime($schedule->start_time)) . '～' . date('H:i',  strtotime($schedule->end_time)) }}</h5>
                                <div class="text-center">
                                    {!! Form::open(['route'=>'count.show', 'method'=>'get']) !!}
                                        @if (new DateTime(date("H:i")) >= new DateTime(strtotime($schedule->start_time)) || App\Schedule::findOrFail($schedule->id)-> loadCount('reserves')->reserves_count >= $schedule -> reserve_max_count )
                                            {!! Form::submit('予約購入' , ['class'=>'btn btn-secondary rounded-pill', 'disabled' => 'disabled']) !!}
                                        @else
                                            {{ Form::hidden('theater_id', '1') }}
                                            {{ Form::hidden('schedule_id', $schedule->id) }}
                                            {!! Form::submit('予約購入' , ['class'=>'btn btn-secondary rounded-pill']) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    
@endsection