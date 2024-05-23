@extends('albums.index')

@section('name')

    <div class="d-flex align-items-start flex-column">
        <h4 class="mb-3">
            <a href="{{ route('user.group') }}">{{ $group->name }}</a>
            /
            @if($album->parent)
                <a href="{{ route('showGroupAlbum', $album->parent) }}">{{ $album->parent->name }}</a>
                /
            @endif
            <span>{{ $album->name }}</span>
        </h4>

        @if(!$album->parent)
            <button type="button" class="btn btn-outline-dark me-3" data-bs-toggle="modal" data-bs-target="#createSubAlbum">
                <i class="bx bx-book-add"></i>
                Створити особистий альбом
            </button>
        @endif
    </div>

@endsection

@section('album-content')

    <!-- Create sub-album modal window -->
    <form action="{{ route('albums.store') }}" method="post">
        @csrf
        <div class="modal fade" id="createSubAlbum" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Додайте назву альбому</h5>
                    </div>

                    <div class="modal-body pb-1 pt-1">
                        <div class="row">
                            <div class="col mb-1">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Назад
                        </button>
                        <input value="{{ $group->id }}" type="hidden" name="group">
                        <input value="{{ $album->id }}" type="hidden" name="parent-album">
                        <button type="submit" class="btn btn-outline-primary">Зберегти</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End create sub-album modal window -->

    <div class="mb-4 d-flex justify-content-start flex-wrap">
        @foreach($subAlbums as $subAlbum)
            @include('albums.wrapper', ['album' => $subAlbum])
        @endforeach
    </div>

    @if($photos->isNotEmpty())
        @include('main.image')
    @endif

    @if($subAlbums->isEmpty() && $photos->isEmpty())
        <h2 class="text-center mt-5">
            Цей альбом поки що порожній...
        </h2>
    @endif

@endsection
