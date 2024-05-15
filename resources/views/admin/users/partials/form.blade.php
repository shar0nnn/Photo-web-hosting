<form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="post">
    @csrf
    @if(isset($user))
        @method('PATCH')

        <input type="hidden" name="user-id" value="{{ $user->id }}">
    @endif

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Ім'я</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name"
                   placeholder="Іван" value="{{ old("name", $user->name ?? '' )}}">
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Група</label>
        <div class="col-sm-10">
            <select class="form-select" name="group">
                <option value="">Немає</option>
                @foreach(\App\Models\Group::all() as $group)
                    <option {{ old("group", isset($user) ? $user->group_id : '') == $group->id ? 'selected' : '' }}
                            value="{{ $group->id }}">
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control"
                   placeholder="example@gmail.com" value="{{ old("email", $user->email ?? '') }}">
        </div>
    </div>

    @if(!isset($user))
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password">
            </div>
        </div>
    @endif

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Роль</label>
        <div class="col-sm-10">
            <select class="form-select" name="role">
                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                    <option
                        {{ old("role", isset($user) ? $user->getRoleNames()->first() : '') == $role->name ? 'selected' : '' }}
                        value="{{ $role->name }}">{{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-12 d-flex justify-content-between">
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Назад</a>
        <button type="submit" class="btn btn-outline-primary">Зберегти</button>
    </div>
</form>
