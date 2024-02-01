<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Discount\DiscountController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\test\TestController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Shift\ShiftController;
use Illuminate\Support\Facades\Route;

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
// Route::get('/login',[LoginController::class, 'getLoginForm']);
// Route::post('/login',[LoginController::class, 'postLoginForm'])->name('login');
// Route::get('/logout',[LoginController::class, 'logout']);

Route::get('/sg-backend/unauthorize',[TestController::class, 'unauthorize']);
Route::get('/sg-backend/login',[LoginController::class, 'getBackendLogin']);
Route::post('/sg-backend/login',[LoginController::class, 'postLoginform'])->name('backend-login');
Route::get('/sg-backend/logout',[LoginController::class, 'logout'])
;
Route::group(['prefix' => 'sg-backend', 'middleware' => 'admin'], function(){
    Route::get('/index',[DashboardController::class, 'index']);

    Route::group(['prefix' => 'shift'],function() {
        Route::get('/',[ShiftController::class, 'index']);
        Route::get('/start',[ShiftController::class, 'start']);
        Route::get('/end',[ShiftController::class, 'end']);
    });

    Route::group(['prefix' => 'item'],function() {
        Route::get('/create',[ItemController::class, 'create']);
        Route::post('/create',[ItemController::class, 'store'])->name('storeFormItem');
        Route::get('/',[ItemController::class, 'itemList']);
        Route::get('/edit/{id}',[ItemController::class, 'edit']);
        Route::post('/update',[ItemController::class, 'update'])->name('updateFormItem');
        Route::post('/delete',[ItemController::class, 'delete']);
    });

    Route::group(['prefix' => 'category'], function() {
        Route::get('/create',[CategoryController::class, 'create']);
        Route::post('/create',[CategoryController::class, 'store'])->name('storeFormCategory');
        Route::get('/',[CategoryController::class, 'categoryList']);
        Route::get('/edit/{id}',[CategoryController::class, 'edit']);
        Route::post('/update',[CategoryController::class, 'update'])->name('updateFormCategory');
        Route::post('/delete',[CategoryController::class, 'delete']);
    });

    Route::group(['prefix' => 'discount'], function(){
        Route::get('/create',[DiscountController::class, 'index']);
        Route::get('/',[DiscountController::class, 'discountList']);
    });

    Route::group(['prefix' => 'setting'],function(){
        Route::get('/create',[SettingController::class, 'settingCreate']);
        Route::get('/',[SettingController::class, 'settingList']);
    });

    Route::group(['prefix' => 'admin'],function() {
        Route::get('/create',[SettingController::class, 'settingCreate']);
        Route::get('/',[SettingController::class, 'settingList']);
    });

    Route::group(['prefix' => 'cashier'],function() {
        Route::get('/create',[SettingController::class, 'settingCreate']);
        Route::get('/',[SettingController::class, 'settingList']);
    });
});



// Route::group(['prefix' => 'test', 'middleware' => 'admin'], function() {
//     Route::get('/',[TestController::class, 'index']);
//     Route::get('/form',[TestController::class, 'showForm']);
//     Route::post('/form/store',[TestController::class, 'storeForm'])->name('storeForm');
//     Route::get('/listing',[TestController::class, 'showList'])->name('showList');
//     Route::get('/edit/{id}',[TestController::class, 'showEdit']);
//     Route::post('/form/update',[TestController::class, 'updateForm'])->name('updateForm');
//     Route::get('/delete/{id}',[TestController::class, 'showDelete']);
// });
// Route::middleware('admin')->group(function(){

// });
