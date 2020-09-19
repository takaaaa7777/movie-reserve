<div class="d-flex flex-row justify-content-between">
    <p class="{{ Request::routeIs('count.show') ? 'font-weight-bold' : 'text-muted' }}">①チケット枚数選択</p>
    <p class="text-muted">＞</p>
    <p class="{{ Request::routeIs('select.show') ? 'font-weight-bold' : 'text-muted' }}">②券種選択</p>
    <p class="text-muted">＞</p>
    <p class="{{ Request::routeIs('confirm.show') ? 'font-weight-bold' : 'text-muted' }}">③購入内容確認</p>
    <p class="text-muted">＞</p>
    <p class="{{ Request::routeIs('reserves.store') ? 'font-weight-bold' : 'text-muted' }}">④完了</p>
</div>