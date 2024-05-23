@extends('template.main')

@section('content')

   @include('partials.filter-sort-panel')

    <div class="row images-wrapper mb-5">
        @include('main.image')
    </div>

   <!-- Hidden input fields -->
    <input type="hidden" id="start" value="0">
    <input type="hidden" id="photos-per-page" value="{{ \App\Models\Photo::PHOTOS_PER_PAGE }}">
    <input type="hidden" id="all-photos" value="{{ $allPhotos }}">
    <input type="hidden" id="group" value="{{ $groupId ?? null }}">
    <input type="hidden" id="is-public" value="{{ $isPublic }}">
    <input type="hidden" id="user-id" value="{{ $userId }}">
    <input type="hidden" id="route-scroll" value="{{ route('getPhotos') }}">
   <!-- End hidden input fields -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('scripts')

    @vite('resources/js/infinite-scroll.js')

@endsection
