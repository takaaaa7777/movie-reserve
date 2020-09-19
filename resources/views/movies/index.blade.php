@extends('layouts.app')

@section('content')
    
    {{-- ナビゲーションタブ表示 --}}
    @include('commons.nav_tabs')

    <div class="text-center bg-dark text-white">
        <h1>上映作品</h1>
    </div>
    
    @foreach ($movies as $movie)
        <div class="card mt-3">
            <div class="card-header bg-dark text-white">
                {{ $movie->title }}
            </div>
            <div class="card-body row">
                <aside class="col-sm-4">
                    <img src={{ $movie->movie_img }} alt="映画イメージ" width="100%" height="300">
                </aside>
                <div class="col-sm-8">
                    <h5>作品詳細内容</h5>
                    <p class="ml-3">{!! nl2br(e($movie->content)) !!}</p>
                    <div class="d-flex flex-row">
                        <h5><span class="badge badge-light">監督</span></h5>
                        <P class='pt-1 ml-2'>{{ $movie-> director }}</P>
                    </div>
                    <div class="d-flex flex-row">
                        <h5><span class="badge badge-light">出演</span></h5>
                        <P class='pt-1 ml-2'>{{ $movie-> cast }}</P>
                    </div>
                </div>
            </div>
        </div>
    
    @endforeach
    
@endsection