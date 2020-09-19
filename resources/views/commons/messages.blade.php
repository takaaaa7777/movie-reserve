<!-- フラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif

<!-- エラーメッセージ -->
@if (count($errors) > 0)
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>    
        @endforeach
    </ul>
@endif
