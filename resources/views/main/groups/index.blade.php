@extends('template.main')

@section('content')

    <div class="card shadow-lg mb-3">
        <div class="card-body d-flex justify-content-between">
            <h3 class="mb-0">Група {{ $group->name }}</h3>

            <div class="d-flex">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                        data-bs-target="#createGroupAlbum">
                    <i class='bx bx-book-add'></i>
                    Створити груповий альбом
                </button>
            </div>
        </div>
    </div>

    <!-- Create group album modal window -->
    <form action="{{ route('albums.store') }}" method="post">
        @csrf
        <div class="modal fade" id="createGroupAlbum" tabindex="-1" style="display: none;" aria-hidden="true">
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
                        <button type="submit" class="btn btn-outline-primary">Зберегти</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End create group album modal window -->

    <div class="mb-5 d-flex justify-content-start flex-wrap">
        @foreach($groupAlbums as $album)
            @include('albums.wrapper')
        @endforeach
    </div>

@endsection
