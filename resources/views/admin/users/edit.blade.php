@extends('template.main')

@section('content')

    <div class="col-xxl">
        <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Редагування користувача</h5>
                        </div>
            <div class="card-body">

                @include('admin.users.partials.form')

            </div>
        </div>
    </div>

@endsection
