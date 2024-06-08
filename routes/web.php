<?php

use App\Livewire\Admin\Masjids\MasjidsIndex;
use App\Livewire\Admin\Masjids\MasjidsShow;
use App\Livewire\Admin\Permissions\PermissionsIndex;
use App\Livewire\Admin\Roles\RolesIndex;
use App\Livewire\Admin\Users\UsersIndex;
use App\Livewire\Murobbi\Santris\SantrisIndex;
use App\Livewire\Santri\Home\HomeIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return redirect()->route('login');
});

Route::middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::get('/home', HomeIndex::class)->name('home');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/masjids', MasjidsIndex::class)->name('masjids.index');
        Route::get('/masjids/{masjid}', MasjidsShow::class)->name('masjids.show');

    });

    Route::get('/santris', SantrisIndex::class)->name('santris.index');

    Route::get('/permissions', PermissionsIndex::class)->name('permissions.index');

    Route::get('/roles', RolesIndex::class)->name('roles.index');

    Route::get('/user', UsersIndex::class)->name('users.index');
});