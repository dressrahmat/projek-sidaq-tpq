<?php

use App\Livewire\Home\Home\HomeIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Santri\Home\HomeMenu;
use App\Livewire\Admin\Roles\RolesIndex;
use App\Livewire\Admin\Users\UsersIndex;
use App\Livewire\Admin\Masjids\MasjidsShow;
use App\Livewire\Home\Home\HomeProfileForm;
use App\Livewire\Admin\Masjids\MasjidsIndex;
use App\Livewire\Admin\Profile\ProfileIndex;
use App\Livewire\Santri\Hafalan\HafalanIndex;
use App\Livewire\Murobbi\Santris\SantrisIndex;
use App\Livewire\Admin\Permissions\PermissionsIndex;

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

Route::get('/beranda', HomeIndex::class)->name('beranda');

Route::middleware(['auth', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/profiles', HomeProfileForm::class)->name('profile.create');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth', config('jetstream.auth_session'), 'verified', 'role:santri'])->group(function () {
    
    Route::get('/home', HomeMenu::class)->name('home');
    
    Route::get('/hafalan', HafalanIndex::class)->name('hafalan.index');
    
});

Route::middleware(['auth', config('jetstream.auth_session'), 'verified', 'role:superadmin|admin|ustadz'])->group(function () {
    
    

    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('/masjids', MasjidsIndex::class)->name('masjids.index');
        Route::get('/masjids/{masjid}', MasjidsShow::class)->name('masjids.show');

    });

    Route::get('/santris', SantrisIndex::class)->name('santris.index');

    Route::get('/permissions', PermissionsIndex::class)->name('permissions.index');

    Route::get('/roles', RolesIndex::class)->name('roles.index');

    Route::get('/user', UsersIndex::class)->name('users.index');

    Route::get('/profile', ProfileIndex::class)->name('profile.index');
});