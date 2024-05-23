@if(isset($groups))
    <div class="card overflow-hidden mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <form method="get">
                        @csrf
                        <label class="col-form-label">Виберіть групу</label>
                        <select class="form-select select2" name="group">
                            <option value="">Всі</option>
                            @foreach($groups as $group)
                                <option {{ isset($groupId) && $groupId == $group->id ? 'selected' : '' }}
                                        value="{{ $group->id }}">
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="mt-4 text-center">
                        Вибрано фото {{ $allPhotos }} з {{ $numberOfPublicPhotos }}
                    </div>
                </div>

                @if(isset($groupId))
                    <div class="col-sm-6 col-lg-4">
                        <div class="mt-4 text-center">
                            <a class="text-primary" href="{{ route('main', ['group' => null]) }}">Скинути фільтр</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="card overflow-hidden mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                        Всього фото - {{ $allPhotos }}
                </div>
            </div>
        </div>
    </div>
@endif
