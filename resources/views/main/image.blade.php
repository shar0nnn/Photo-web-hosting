@foreach($photos as $photo)
    <div class="col-md-6 col-lg-4 mb-3 image">
        <div class="card h-100">
            <div class="card-header pt-3 pb-1">
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

            <a class="image-link" img-title="{{ $photo->name }}"
               href="{{ \Illuminate\Support\Facades\Storage::url(\App\Models\Photo::PHOTO_PATH) . $photo->user_id . '/' . $photo->original_name }}">
                <div class="img-wrapper">
                    <img class="img-fluid img-standard"
                         src="{{ \Illuminate\Support\Facades\Storage::url(\App\Models\Photo::PHOTO_PATH) . $photo->user_id . '/min_' . $photo->original_name }}"
                         alt="Card image cap">
                </div>
            </a>

            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-text">{{ $photo->created_at }}</p>

                    @if($photo->album_id !== null)
                        <span>{{ $photo->album->name }}</span>
                    @else
                        <span></span>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    @if(auth()->id() === $photo->user_id)
                        <div class="icon-container is-public-container"
                             data-url="{{ route('photo.update', $photo->id) }}"
                             data-value="{{ $photo->is_public === false ? 0 : 1 }}"
                             title="{{ $photo->is_public === true ? "Зробити приватною" : "Зробити публічною" }}">
                            <i class="bx bx-show font-size-28 is-public-icon {{ $photo->is_public === true ? "active" : "" }}"></i>
                        </div>
                    @else
                        <div></div>
                    @endif

                    @auth()
                        <div class="like-wrapper">
                            <div class="icon-container icon-container-heart like-photo-container me-3"
                                 data-value="{{ $photo->currentUserLikes->isNotEmpty() ? 0 : 1 }}"
                                 data-url="{{ route('photo.like', $photo->id) }}">
                                <i class='bx font-size-25 {{ $photo->currentUserLikes->isNotEmpty() ? "bxs-heart" : "bx-heart" }} like-icon'></i>
                            </div>

                            <div class="likes-count d-inline">{{ $photo->usersLikes->count() }}</div>
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </div>
@endforeach
