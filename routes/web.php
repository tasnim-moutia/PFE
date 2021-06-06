<?php

use Illuminate\Support\Facades\Route;
use\App\Http\Controllers\AdController;
use\App\Http\Controllers\HomeController;
use\App\Http\Controllers\AdminController;
use\App\Http\Controllers\UserController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EchangeController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\AnnonceController::class, 'annonce']);


Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});

/*Home*/
Route::get('/home', [App\Http\Controllers\AnnonceController::class, 'index1'])->middleware('isUser')->name('home');
/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('isUser')->name('home');*/
/*Route::get('/home', [App\Http\Controllers\AdController::class, 'carosel'])->middleware('isUser');*/


/*Admin*/
Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin', 'auth', 'PreventBackHistory'], function(){
    Route::get('dashborad', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profil', [AdminController::class, 'profil'])->name('admin.profil');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
});
Route::get('/dashboards/admins/edit-profil/{id}', [AdminController::class, 'edit'])->name('profil.edit');
Route::post('/dashboards/admins/update-profil/{id}', [AdminController::class, 'update'])->name('profil.update');

/*user*/ 
Route::group(['prefix'=>'user', 'middleware'=>'isUser', 'auth', 'PreventBackHistory'], function(){
    Route::get('dashborad', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profil', [UserController::class, 'profil'])->name('user.profil');
    //Route::get('settings', [UserController::class, 'settings'])->name('user.settings');
});
Route::get('/dashboards/users/edit-profil/{id}', [UserController::class, 'edit'])->name('userpro.edit');
Route::post('/dashboards/users/update-profil/{id}', [UserController::class, 'update'])->name('userpro.update');

/*avis*/
Route::get('/ajouter-avis', [AvisController::class, 'ajouterAvis'])->name('ajouter.avis');
Route::post('/ajouter-avis', [AvisController::class, 'saveAvis'])->name('save.avis');
Route::get('/dashboards/admins/avis/avis-list', [AvisController::class, 'avisList'])->name('avis.list');
Route::get('/dashboards/admins/avis/edit-avis/{id}', [AvisController::class, 'editAvis'])->name('edit.avis'); 
/*Route::get('/dashboards/admins/avis/delete-avis/{id}', [AvisController::class, 'deleteAvis'])->name('delete.avis');*/
Route::post('/dashboards/admins/avis/update-avis', [AvisController::class, 'updateAvis'])->name('update.avis');
Route::DELETE('/dashboards/admins/avis/delete-avis/{id}', [App\Http\Controllers\AvisController::class, 'destroy'])->name('delete.avis');


/*Admin categorie*/
Route::get('/dashboards/admins/categories/create', [CategorieController::class, 'create'])->name('create.categorie');
Route::post('/dashboards/admins/categories/create', [CategorieController::class, 'store'])->name('store.categorie');
Route::get('/dashboards/admins/categories/index', [CategorieController::class, 'index'])->name('categorie.list');
Route::get('/dashboards/admins/categories/edit/{id}', [CategorieController::class, 'edit'])->name('edit.categories'); 
/*Route::get('/dashboards/admins/categories/delete/{id}', [CategorieController::class, 'destroy'])->name('delete.categories');*/
Route::post('/dashboards/admins/categories/update', [CategorieController::class, 'update'])->name('update.categories');
Route::DELETE('/dashboards/admins/categories/delete-categorie/{id}', [App\Http\Controllers\CategorieController::class, 'destroy'])->name('delete.categorie');

/*Consulter categorie user */
Route::get('/catégories/categorie', [CategorieController::class, 'show'])->name('show.categorie');
Route::get('/catégories/annonces', [AnnonceController::class, 'categorie'])->name('annonce.categorie');


/*Mes annonces*/
Route::get('/annonce/index', [AnnonceController::class, 'index'])->middleware('auth')->name('annonce.list');
Route::get('/annonce/publier', [AnnonceController::class, 'create'])->middleware('auth')->name('add.annonce');
Route::post('/annonce/publier', [AnnonceController::class, 'store'])->middleware('auth')->name('store.annonce');
Route::get('/annonce/modifier/{id}', [AnnonceController::class, 'edit'])->middleware('auth')->name('edit.annonce');
Route::post('/annonce/update/{id}', [AnnonceController::class, 'update'])->middleware('auth')->name('update.annonce');
/*Route::get('/annonce/supprimer/{id}', [AnnonceController::class, 'delete'])->name('delete.annonce');*/
Route::DELETE('/annonce/supprimer/{id}', [App\Http\Controllers\AnnonceController::class, 'destroy'])->name('annonce.destroy');

/*Recherche*/
Route::get('/recherche', [AnnonceController::class, 'recherche'])->name('annonce.search');
/*détails*/
Route::get('/détails/{id}', [AnnonceController::class, 'show'])->name('annonce.show');

/*demande échange*/
Route::get('/demande-echange/{id}', [EchangeController::class, 'echange'])->middleware('auth')->name('demande.echange');
Route::post('/demande-echange', [EchangeController::class, 'store'])->name('echange.store');


/*Admin Gérer annonces*/
Route::get('/dashboards/admins/annonces/list-annonces', [AnnonceController::class, 'list'])->name('list.annonce');
/*Route::get('/dashboards/admins/annonces/delete/{id}', [AnnonceController::class, 'destroy'])->name('annonce.delete');*/
Route::get('/dashboards/admins/annonces/edit-annonce/{id}', [AnnonceController::class, 'modifier'])->name('annonce.edit');
Route::post('/dashboards/admins/annonces/update/{id}', [AnnonceController::class, 'updatee'])->name('annonce.update');
Route::post('/dashboards/admins/annonces/list-annonces/{id}', [AnnonceController::class, 'validatee'])->name('validate.annonce');
Route::get('/dashboards/admins/annonces/show-annonce/{id}', [AnnonceController::class, 'shows'])->name('show.annonce');
Route::DELETE('/dashboards/admins/annonces/delete-annonce/{id}', [App\Http\Controllers\CategorieController::class, 'delete'])->name('annonce.delete');


/*Lancer Publicité*/
Route::get('/annonce/lancer-ad', [AdController::class, 'create'])->name('create.ad');
Route::post('/annonce/lancer-ad', [AdController::class, 'store'])->name('store.ad');

/*Admin gérer les publicités*/
Route::get('/dashboards/admins/ads/list-ads', [AdController::class, 'list'])->name('list.ads');
Route::post('/dashboards/admins/ads/list-ads/{id}', [AdController::class, 'confirm'])->name('confirm.ads');
Route::get('/dashboards/admins/ads/détails-annonce/{id}', [AdController::class, 'details'])->name('detail.annonce');
Route::DELETE('/dashboards/admins/ads/delete-ad/{id}', [App\Http\Controllers\AdController::class, 'destroy'])->name('ad.delete');

/*Admin gérer users */
Route::get('/dashboards/admins/users/users-list', [UserController::class, 'list'])->name('users.list');
Route::post('/dashboards/admins/users/users-list/{id}', [UserController::class, 'valid'])->name('validate.user');
/*Route::get('/dashboards/admins/users/delete/{id}', [UserController::class, 'delete'])->name('delete.user');*/
Route::DELETE('/dashboards/admins/users/delete-user/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete.user');

/*Notification */
Route::get('/notification', [NotificationController::class, 'index'])->name('notification.list');
Route::DELETE('/notification/{id}', [App\Http\Controllers\NotificationController::class, 'destroy'])->name('delete.notification');

/*Chat */
Route::get('/chat', [HomeController::class, 'chat'])->name('user.chat');
Route::get('/conversation/{userId}', [App\Http\Controllers\MessageController::class, 'conversation'])
    ->name('message.conversation');
Route::post('send-message', [App\Http\Controllers\MessageController::class, 'sendMessage'])
    ->name('message.send-message');

/*contact*/
Route::get('/contact', [AvisController::class, 'contact'])->name('contact.list');   