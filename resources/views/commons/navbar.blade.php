<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">MovieTheater</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    @if (Auth::user()->admin_flg==0)
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">管理者操作</a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item">{!! link_to_route('movies.create', '上映作品登録') !!}</li>
                                <li class="dropdown-item">{!! link_to_route('schedules.create', '上映スケジュール登録') !!}</li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class'=>'nav-link']) !!}</li>
                @else
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class'=>'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('signup.get', '新規会員登録', [], ['class'=>'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>