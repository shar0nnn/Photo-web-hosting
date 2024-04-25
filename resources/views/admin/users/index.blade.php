@extends('template.main')

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between pt-3 pb-3">
            <h4 class="mb-0 mt-2">Список користувачів вебхостингу</h4>
            <form action="{{ route('users.create') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Додати користувача</button>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>Ім'я</th>
                    <th>Група</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Дії</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($users as $user)
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger me-3"></i> {{ $user->name }}
                        </td>

                        <td>
                            @if($user->group != null)
                                {{ $user->group->name }}
                            @endif
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        @if($user->hasRole('admin'))
                            <td><span class="badge bg-label-primary me-1">Admin</span></td>
                        @else
                            <td><span class="badge bg-label-warning me-1">User</span></td>
                        @endif

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i>Редагувати</a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
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
