@extends('template.main')

@section('content')

    <div class="row mb-5">
        @include('main.image')
    </div>

    <input type="hidden" id="start" value="0">
    <input type="hidden" id="photos-per-page" value="{{ $photosPerPage }}">
    <input type="hidden" id="all-photos" value="{{ $allPhotos }}">
    <input type="hidden" id="route-scroll" value="{{ route('user.photos.getPhotos') }}">

    {{--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('scripts')

    @vite('resources/js/infinite-scroll.js')

@endsection
