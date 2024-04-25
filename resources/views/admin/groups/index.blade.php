@extends('template.main')

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between pt-3 pb-3">
            <h4 class="mb-0 mt-2">Список груп</h4>
            <form action="{{ route('groups.create') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Створити групу</button>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>Назва</th>
                    <th class="text-center">Кількість учасників</th>
                    <th>Дії</th>
                </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                @foreach($groups as $group)
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i>{{ $group->name }}
                        </td>

                        <td class="text-center">
                            {{ $group->users->count() }}
                        </td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('groups.edit', $group->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i>Редагувати</a>
                                    <form action="{{ route('groups.destroy', $group->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item"><i class="bx bx-trash me-1"></i>Видалити</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
