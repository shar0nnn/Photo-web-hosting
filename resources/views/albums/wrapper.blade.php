<a href="{{ route('showGroupAlbum', $album->id) }}">
    <div class="album-wrapper me-3 mb-3">
        <div class="card">
            <div class="card-header pt-3 pb-1" style="position: relative; height: 250px">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">{{ \Illuminate\Support\Str::limit($album->name, 10) }}</h5>
                    <h6>Фото: {{ $album->countPhotos() }}</h6>
                </div>

                <div class="album-img-wrapper">
                    <img class="img-thumbnail"
                         src="{{ $album->getFirstMinPhotoPath() }}"
                         alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
</a>
