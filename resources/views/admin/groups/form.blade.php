@extends('template.main')

@section('content')

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">{{ isset($group) ? 'Редагування групи' : 'Створення нової групи' }}</h5>
            </div>
            <div class="card-body">

                <form action="{{ isset($group) ? route('groups.update', $group->id) : route('groups.store') }}"
                      method="post">
                    @csrf
                    @if(isset($group))
                        @method('PATCH')
                    @endif

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Назва</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name"
                                   placeholder="ТП-111" value="{{ old("name", $group->name ?? '' )}}">
                            <input type="hidden" name="group-id" value="{{ $group->id }}">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-between">
                        <a href="{{ route('groups.index') }}" class="btn btn-outline-secondary">Назад</a>
                        <button type="submit" class="btn btn-outline-primary">Зберегти</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
