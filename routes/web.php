<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('main');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/user/photos', [\App\Http\Controllers\MainController::class, 'showUserPhotos'])->name('user.photos');
    Route::get('/user/photos/getPhotos', [\App\Http\Controllers\MainController::class, 'getPhotos'])->name('user.photos.getPhotos');
//    Route::get('/user/albums', [\App\Http\Controllers\MainController::class, 'showUserAlbums'])->name('user.albums');

    Route::post('/photo/store', [\App\Http\Controllers\PhotoController::class, 'store'])->name('photo.store');
    Route::post('/albums/{album}/photo/store', [\App\Http\Controllers\PhotoController::class, 'store'])->name('album.photo.store');
    Route::patch('/photos/{photo}/update', [\App\Http\Controllers\PhotoController::class, 'update'])->name('photo.update');
    Route::post('/photos/{photo}/like', [\App\Http\Controllers\PhotoController::class, 'like'])->name('photo.like');
    Route::delete('/photos/{photo}/destroy', [\App\Http\Controllers\PhotoController::class, 'destroy'])->name('photo.destroy');

    Route::get('/albums/{album}', [\App\Http\Controllers\AlbumController::class, 'index'])->name('album.index');
    Route::post('/album/store', [\App\Http\Controllers\AlbumController::class, 'store'])->name('album.store');
    Route::delete('/albums/{album}/destroy', [\App\Http\Controllers\AlbumController::class, 'destroy'])->name('album.destroy');

    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['role:admin']], function () {
//    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
//    Route::get('/users/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
//    Route::post('/users/store', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
//    Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
//    Route::patch('/users/{user}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
//    Route::delete('/users/{user}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('groups', \App\Http\Controllers\GroupController::class);
});
