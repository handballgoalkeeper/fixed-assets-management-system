@if(!is_null(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
@if(isset($error))
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endif

