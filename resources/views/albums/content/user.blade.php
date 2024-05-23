@extends('albums.index')

@section('name')

    <h3 class="mb-0">{{ $album->name }}</h3>

@endsection

@section('album-content')

    @if($photos->isNotEmpty())
        @include('main.image')
    @else
        <h2 class="text-center mt-5">
            Цей альбом поки що порожній...
        </h2>
    @endif

@endsection
