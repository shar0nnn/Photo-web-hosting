<a href="{{ route('showGroupAlbum', $album->id) }}">
    <div class="album-wrapper me-3 mb-3">
        <div class="card">
            <div class="card-header pt-3 pb-1" style="position: relative; height: 250px">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">{{ \Illuminate\Support\Str::limit($album->name, 10) }}</h5>
                    <h6>Фото: {{ $album->countPhotos() }}</h6>
                </div>

                <div class="album-img-wrapper">
                    @if($album->photos->isNotEmpty())
                        <img src="{{ \Illuminate\Support\Facades\Storage::url(\App\Models\Photo::PHOTO_PATH) . $album->photos->first()->user_id . '/min_' . $album->photos->first()->original_name }}"
                             alt="Card image cap">
                    @else
                        <img class="img-thumbnail"
                             src="{{ asset('assets/img/empty_album_placeholder.avif') }}"
                             alt="Card image cap">
                    @endif
                </div>
            </div>
        </div>
    </div>
</a>
