<div class="card">
    <div class="card-header bg-dark text-white text-center ">
        <h5>購入内容</h5>
    </div>
    <div class="card-body">
        <div>
            <p class="mb-0">作品名</p>
            <p class="mt-0">{{ $movie->title }}</p>
        </div>
        <div>
            <p class="mb-0">日時</p>
            <p class="mt-0 mb-0">{{ date('Y年m月d日',  strtotime($schedule->screening_date)) }}</p>
            <p class="mt-0">{{ ltrim(date('H:i',  strtotime($schedule->start_time)), 0). "～". ltrim(date('H:i',  strtotime($schedule->end_time)), 0) }}</p>
        </div>
        @if (Request::routeIs('select.show')) 
            <div>
                <p class="mb-0">チケット枚数</p>
                <p class="mt-0">{{ $ticket_count. "枚" }}</p>
            </div>
        @endif
        @if (Request::routeIs('confirm.show'))
            <div>
                <p class="mb-0">チケット枚数</p>
                <p class="mt-0">{{ $ticket_count. "枚" }}</p>
            </div>
            <div>
                <p class="mb-0">券種</p>
                @foreach ($tickets_type as $ticket_type)
                    <p class="mt-0 mb-0">{{ $ticket_type['name'] }} <span ml-2>{{ $ticket_type['count'] }}枚</span></p>
                @endforeach
            </div>
            <div class ="mt-2">
                <p class="mb-0">金額</p>
                <p class="mt-0 mb-0">&yen; {{ number_format($total_price) }}</p>
            </div>
        @endif
    </div>
</div>