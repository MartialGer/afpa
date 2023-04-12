<?php

use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CtrlNDS;
use App\Http\Controllers\CtrlRCS;

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

Route::get('/', function () {
    return view('welcome');
});

/////ADMIN 
Route::prefix('/admin')->middleware('role:admin')->group(function () {
    //NDS
    Route::get('/note_de_services', [CtrlNDS::class, 'indexAdminNDS'])->name('indexAdminNDS');
    Route::get('/note_de_services/nouveau', [CtrlNDS::class, 'afficherFormulaireNDS'])->name('createNDS');
    Route::post('/note_de_services/nouveau', [CtrlNDS::class, 'nouveauNDS'])->name('saveNDS');
    Route::get('/note_de_services/{slug}/modifier', [CtrlNDS::class, 'selectNDS'])->name('selectNDS');
    Route::put('/note_de_services/{slug}', [CtrlNDS::class, 'editNDS'])->name('updateNDS');
    Route::delete('/admin/note_de_services/{slug}', [CtrlNDS::class, 'softDeleteNDS'])->name('DeleteNDS');

    //RCS
    Route::get('/reglements', [CtrlRCS::class, 'indexAdminRCS'])->name('indexAdminRCS');
    Route::get('/reglements/nouveau', [CtrlRCS::class, 'afficherFormulaireRCS'])->name('createRCS');
    Route::post('/reglements/nouveau', [CtrlRCS::class, 'nouveauRCS'])->name('saveRCS');
    Route::get('/reglements/{slug}/modifier', [CtrlRCS::class, 'selectRCS'])->name('selectRCS');
    Route::put('/reglements/{slug}/modifier', [CtrlRCS::class, 'editRCS'])->name('updateRCS');
});

/////USER
//NDS
Route::get('/note_de_services', [CtrlNDS::class, 'indexNDS'])->name('indexNDS');
Route::get('/note_de_services/{slug}', [CtrlNDS::class, 'pageNDS'])->name('pageNDS');
//RCS
Route::get('/reglements', [CtrlRCS::class, 'indexRCS'])->name('indexRCS');
Route::get('/reglements/{slug}', [CtrlRCS::class, 'pageRCS'])->name('pageRCS');
Route::resource('admin/evenements', 'App\Http\Controllers\EvenementController')->middleware('role:Super Admin, Admin Evenement');
Route::get('/evenements', [EvenementController::class, 'indexUser'])->name('evenements.indexUser');
Route::get('/evenements/{evenement}', [EvenementController::class, 'showUser'])->name('evenements.showUser');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
