@if ($message = Session::get('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
