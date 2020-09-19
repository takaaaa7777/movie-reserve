<div class="mb-3">
    <ul class="nav nav-tabs nav-justified bg-secondary">
        <li class="nav-item border">
            <a href="{{ route('schedules.index') }}" class="nav-link text-white">上映スケジュール</a>
        </li>
        <li class="nav-item border">
            <a href="{{ route('movies.index') }}" class="nav-link text-white">上映作品</a>
        </li>
        <li class="nav-item border">
            <a href="{{ route('theaters.show',['id' => 1]) }}" class="nav-link text-white">営業時間・アクセス</a>
        </li>
        <li class="nav-item border">
            <a href="{{ route('tickets.show',['id' => 1]) }}" class="nav-link text-white">料金</a>
        </li>
    </ul>
</div>
 