@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        <strong>{{ session('status') }}</strong>
    </div>
@endif
