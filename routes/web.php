<?php

use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CtrlNDS;
use App\Http\Controllers\CtrlRCS;
use App\Http\Controllers\CtrlMeteo;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsController;

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
    return view('meteoWidget');
})->name('welcome');

/////ADMIN 
// Route::prefix('/admin')->middleware('role:Super Admin')->group(function () {
Route::prefix('/admin')->group(function () {

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

    //METEO
    Route::get('/meteo', [CtrlMeteo::class, 'afficherFormulaire'])->name('meteo_get');
    Route::post('/meteo', [CtrlMeteo::class, 'selectVilleMeteo'])->name('meteo_post');

    //EVENEMENT
    Route::resource('/evenements', 'App\Http\Controllers\EvenementController')->middleware('role: 1,2');

    //AGENDA
    Route::get('/articles', [ArticleController::class, 'indexAdmin'])->name('articles.admin.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.admin.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.admin.store');
    Route::put('/articles/update{article}', [ArticleController::class, 'update'])->name('articles.admin.update');
    Route::get('/articless/edit{article}', [ArticleController::class, 'edit'])->name('articles.admin.edit');
    Route::delete('/articles/destroy/{article}', [ArticleController::class, 'destroy'])->name('articles.admin.destroy');

    //NEWS
    Route::get('/news', [NewsController::class, 'indexAdmin'])->name('news.admin.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.admin.create');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.admin.store');
    Route::put('/news/update{news}', [NewsController::class, 'update'])->name('news.admin.update');
    Route::get('/news/edit{news}', [NewsController::class, 'edit'])->name('news.admin.edit');
    Route::delete('/news/destroy/{news}', [NewsController::class, 'destroy'])->name('news.admin.destroy');

});

/////USER

//NDS
Route::get('/note_de_services', [CtrlNDS::class, 'indexNDS'])->name('indexNDS');
Route::get('/note_de_services/{slug}', [CtrlNDS::class, 'pageNDS'])->name('pageNDS');

//RCS
Route::get('/reglements', [CtrlRCS::class, 'indexRCS'])->name('indexRCS');
Route::get('/reglements/{slug}', [CtrlRCS::class, 'pageRCS'])->name('pageRCS');

//METEO
Route::get('/', [CtrlMeteo::class, 'afficherWidgetMeteo'])->name('meteo_widget');
Route::get('/meteo', [CtrlMeteo::class, 'afficherPrevMeteo'])->name('meteo_previsionnel');

//EVENEMENT
Route::get('/evenements', [EvenementController::class, 'indexUser'])->name('evenements.indexUser');
Route::get('/evenements/{evenement}', [EvenementController::class, 'showUser'])->name('evenements.showUser');

//AGENDA
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

//NEWS
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

//AUTRE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';