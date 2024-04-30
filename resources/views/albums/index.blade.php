@extends('template.main')

@section('content')

    <div class="card shadow-lg mb-3">
        <div class="card-body d-flex justify-content-between">
            <h3 class="mb-0">{{ $photos->isNotEmpty() ? $album->name : 'Цей альбом порожній' }}</h3>

            <div class="d-flex">
                <button type="button" class="btn btn-outline-dark me-3" data-bs-toggle="modal" data-bs-target="#deleteAlbum">
                    Видалити альбом
                </button>

                <form action="{{ route('album.photo.store', $album->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group max-width">
                        <input class="form-control" type="file" name="photo">
                        <input value="{{ $album->id }}" type="hidden" name="album">
                        <button type="submit" class="mb-0 btn btn-outline-primary">
                            <i class="bx bx-image-add bx-sm"></i>
                            Додати фото
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form action="{{ route('album.destroy', $album->id) }}" method="post">
        @csrf
        @method('delete')
        <div class="modal fade" id="deleteAlbum" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Видалити альбом?</h5>
                    </div>

                    <div class="modal-body pb-1 pt-1">
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">Альбом буде видалено назавжди. Фотографії з видаленого альбому залишаться в вебхостингу</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Назад
                        </button>
                        <button type="submit" class="btn btn-outline-primary">Видалити</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if($photos->isNotEmpty())
        @include('main.image')
    @endif

@endsection
