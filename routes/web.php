<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomePage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategorieController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\ConfigController;
use App\Models\Category;

/*
|
|Backend Routes
|
*/

Route::get('site-bakimda',function(){
  return view('front.offline');
});

Route::prefix('/created')->name('admin.')->middleware('isLogin')->group(function () {
  Route::get('/login', [AuthController::class, 'LogIn'])->name('login');
  Route::post('/login', [AuthController::class, 'LogInPost'])->name('login.post');
});

//panele girsiğimizde middlaware çalışıyor middlaware classına gidip konrol ediyor
//auth işlemini eğer kullanıcı yoksa tekrar logine yonlendiriyor.
Route::prefix('/created')->name('admin.')->middleware('isAdmin')->group(function () {
  Route::get('/panel', [Dashboard::class, 'Index'])->name('home');

  //Makale İşlemleri
  Route::get('makaleler/silinenler', [ArticleController::class, 'trashes'])->name('trashes.articles');
  Route::resource('/makaleler', ArticleController::class);
  Route::get('/swich', [ArticleController::class, 'switch'])->name('switch');

  Route::get('/delete/{id}', [ArticleController::class, 'delete'])->name('delete.article');
  Route::get('/deleting/{id}', [ArticleController::class, 'deleteHard'])->name('deleting.article');

  Route::get('/recover/{id}', [ArticleController::class, 'recover'])->name('recover.article');

  //Kategori işlemleri 
  Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
  Route::get('/category/status', [CategorieController::class, 'switch'])->name('category.switch');
  Route::post('/category/create', [CategorieController::class, 'create'])->name('category.create');
  Route::get('category/getdata', [CategorieController::class, 'getData'])->name('category.getdata');

  Route::post('category/update', [CategorieController::class, 'update'])->name('category.update');
  Route::post('category/delete', [CategorieController::class, 'delete'])->name('category.delete');

  //Pages Routes  
  Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
  Route::get('/pages/status', [PageController::class, 'switch'])->name('page.switch');
  Route::get('/pages/create', [PageController::class, 'create'])->name('page.create');
  Route::post('/pages/create', [PageController::class, 'postCreate'])->name('page.create.post');
  Route::get('/pages/update/{id}', [PageController::class, 'updatePage'])->name('page.edit');
  Route::post('pages/update/{id}', [PageController::class, 'editPage'])->name('page.edit.post');
  Route::get('/pages/delete/{id}', [PageController::class, 'deletePage'])->name('page.delete');
  Route::get('/pages/order', [PageController::class, 'order'])->name('page.order');


  //Config Routes
  Route::get('/settings', [ConfigController::class, 'index'])->name('settings.index');
  Route::post('/settings/update', [ConfigController::class, 'update'])->name('config.update');

  Route::get('/logout', [AuthController::class, 'LogOut'])->name('logout');
});


/*
|
|Frontend Routes
|
*/

Route::get('/', [HomePage::class, 'Index'])->name('homepage');
Route::get('/yazilar', [HomePage::class, 'Index']);
Route::get('/iletisim', [HomePage::class, 'Contact'])->name('contact');
Route::post('/iletisim', [HomePage::class, 'ContactPost'])->name('contact.post');
Route::get('/kategoriler/{ctrgy}', [HomePage::class, 'Category'])->name('categoryRoot');
Route::get('/{category}/{slug}', [HomePage::class, 'Single'])->name('single');
Route::get('/{sayfa}', [HomePage::class, 'Page'])->name('page');
