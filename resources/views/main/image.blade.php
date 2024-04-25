<div class="row mb-5">
    @foreach($photos as $photo)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body pt-3 pb-1">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{ $photo->name }}</h5>
                        @if(auth()->id() === $photo->user_id)
                            <form action="{{ route('photo.destroy', $photo->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <i class='bx bx-trash delete-icon font-size-25' title="Видалити"></i>
                            </form>
                        @endif
                    </div>
                    {{--                        <h6 class="card-subtitle text-muted">Support card subtitle</h6>--}}
                </div>

                <div class="img-wrapper">
                    <img class="img-fluid img-standard"
                         src="{{ $path . $photo->user_id . '/' . $photo->original_name }}"
                         alt="Card image cap">
                </div>

                <div class="card-body">
                    <p class="card-text">{{ $photo->created_at }}</p>

                    <div class="d-flex justify-content-between">
                        @if(auth()->id() === $photo->user_id)
                            <form action="{{ route('photo.update', $photo->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input name="is_public" type="hidden"
                                       value="{{ $photo->is_public === false ? 0 : 1 }}">
                                <i class='bx bx-show font-size-28 is-public-icon {{ $photo->is_public === true ? "active" : "" }}'
                                   title="{{ $photo->is_public === true ? "Зробити приватною" : "Зробити публічною" }}"></i>
                                <i class='bx bx-rotate-right bx-spin font-size-28 d-none'></i>
                            </form>
                        @endif

                        <form action="{{ route('photo.like', $photo->id) }}" method="post">
                            @csrf
                            <input name="is_liked" type="hidden" value="1">
                            <i class='bx bx-heart font-size-25 like-icon'></i>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>
