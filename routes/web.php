<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MCController;
use App\Http\Controllers\RegisterAndLoginController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\AdminController;
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
    return view('main.loginpage');
});

Route::get('home', [MainController::class, 'home']);
Route::get('codequest', [MainController::class, 'codequest']);
Route::get('news', [MainController::class, 'news']);
Route::get('about', [MainController::class, 'about']);
Route::get('profile', [MainController::class, 'profile']);

//Code Quest Routes
Route::get('mpcq', [MainController::class, 'mpcq']);
Route::get('fe', [MainController::class, 'fe']);
Route::get('be', [MainController::class, 'be']);
Route::post('updatePoints', [MCController::class, 'updatePoints']);

Route::get('registersuccess',[SuccessController::class,'registersuccess']);

Route::get('/registerpage', [RegisterAndLoginController::class, 'registerpage']);
Route::get('/loginpage', function () {
    return view('main.loginpage');
});
Route::get('/student-num-exists',[RegisterAndLoginController::class,'studentNumExists']);
Route::post('/register',[RegisterAndLoginController::class,'register']);
Route::post('/login',[RegisterAndLoginController::class,'login']);
Route::post('/signOut',[RegisterAndLoginController::class,'signOut']);
Route::post('/updateProfile',[RegisterAndLoginController::class,'updateProfile']);
Route::post('/uploadPhoto', [RegisterAndLoginController::class, 'uploadPhoto']);


//Routes for admin
Route::get('/admindashboard', [AdminController::class, 'admindashboard']);
Route::get('/adminsubmissions', [AdminController::class, 'adminsubmissions']);
Route::get('adminnews', [AdminController::class, 'adminnews']);
Route::get('/adminusers', [AdminController::class, 'adminusers']);
Route::get('/adminadmins', [AdminController::class, 'adminadmins']);
Route::post('/post', [AdminController::class, 'post']);

Route::get('display', [AdminController::class, 'display']);