<div class="card overflow-hidden mb-4">
    <div class="card-body">
        <div class="row">
            <div class="d-flex justify-content-between">
                @if($isPublic === true)
                    <div class="col-sm-6 col-lg-3">
                        <form method="get">
                            @csrf
                            <label class="col-form-label">Виберіть групу</label>
                            <select class="form-select select2" name="group">
                                <option value="">Всі</option>
                                @foreach(\App\Models\Group::all() as $group)
                                    <option
                                        {{ array_key_exists('group', $sortFilters) && $sortFilters['group'] == $group->id ? 'selected' : '' }}
                                        value="{{ $group->id }}">
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                @endif

                <div>
                    <h5>Сортувати за:</h5>
                    @if(request('date') === 'asc')
                        <a class="me-3" title="Найновіші"
                           href="{{ request()->fullUrlWithQuery(['date' => 'desc', 'likes' => null]) }}">
                            <span class="font-size-17">Датою завантаження</span>
                            <i class='bx bx-sort-down'></i>
                        </a>
                    @else
                        <a class="me-3" title="Найстаріші"
                           href="{{ request()->fullUrlWithQuery(['date' => 'asc', 'likes' => null]) }}">
                            <span class="font-size-17">Датою завантаження</span>
                            <i class='bx bx-sort-up'></i>
                        </a>
                    @endif

                    @if(request('likes') === 'desc')
                        <a href="{{ request()->fullUrlWithQuery(['date' => 'desc', 'likes' => null]) }}">
                            <span class="font-size-17">Кількістю уподобань</span>
                            <i class='bx bx-sort-up'></i>
                        </a>
                    @else
                        <a title="Найпопулярніші"
                           href="{{ request()->fullUrlWithQuery(['likes' => 'desc', 'date' => null]) }}">
                            <span class="font-size-17">Кількістю уподобань</span>
                            <i class='bx bx-sort-down'></i>
                        </a>
                    @endif
                </div>

                @if($isPublic === true)
                    <div class="col-sm-6 col-lg-4">
                        <div class="mt-4 text-center">
                            Вибрано фото {{ $allPhotos }} з {{ $numberOfPublicPhotos }}
                        </div>
                    </div>
                @endif

                @if($isPublic !== true)
                    <div class="col-sm-6 col-lg-3">
                        Всього фото - {{ $allPhotos }}
                    </div>
                @endif
            </div>

            @if(isset($groupId))
                <div class="col-sm-6 col-lg-4">
                    <div class="mt-3 text-start">
                        <a class="text-primary font-size-17" href="{{ route('main', ['group' => null]) }}">Скинути фільтр</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
