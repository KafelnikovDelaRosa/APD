<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MCController;
use App\Http\Controllers\RegisterAndLoginController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeController;
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
Route::post('/updatePoints', [MCController::class, 'updatePoints']);

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
Route::get('/adminchallenges',[AdminController::class,'adminchallenges']);
Route::get('/adminchallenges/multiplechoice',[AdminController::class,'adminMultipleChoice']);
Route::get('/adminchallenges/frontend',[AdminController::class,'adminFrontend']);
Route::get('/adminchallenges/backend',[AdminController::class,'adminBackend']);
Route::get('/adminchallenges/multiplechoice/post',[AdminController::class,'multipleChoiceForm']);
Route::post('/post-multiplechoice',[AdminController::class,'postMultipleChoice']);
Route::post('/update-multiplechoice-post',[AdminController::class,'updateMultipleChoicePost']);
Route::post('/delete-multiplechoice-post',[AdminController::class,'deleteMultipleChoicePost']);
Route::post('/update-multiplechoice-status',[AdminController::class,'updateMultipleChoiceStatus']);
Route::get('/adminchallenges/multiplechoice/editpost/{id}',[AdminController::class,'editMultipleChoiceForm']);
Route::get('/adminchallenges/frontend/post',[AdminController::class,'frontEndForm']);
Route::get('/adminchallenges/frontend/editpost/{id}',[AdminController::class,'editFrontEndForm']);
Route::post('/delete-frontend-post',[AdminController::class,'deleteFrontEndPost']);
Route::post('/update-frontend-post',[AdminController::class,'updateFrontEndPost']);
Route::post('/update-frontend-status',[AdminController::class,'updateFrontEndStatus']);
Route::post('/post-frontend',[AdminController::class,'postFrontEnd']);
Route::get('/adminchallenges/backend/post',[AdminController::class,'backEndForm']);
Route::get('/adminchallenges/backend/editpost/{id}',[AdminController::class,'editBackEndForm']);
Route::post('/post-backend',[AdminController::class,'postBackEnd']);
Route::post('/delete-backend-post',[AdminController::class,'deleteBackEndPost']);
Route::post('/update-backend-status',[AdminController::class,'updateBackendStatus']);
Route::post('/update-backend-post',[AdminController::class,'updateBackEndPost']);
Route::get('/adminsubmissions', [AdminController::class, 'adminsubmissions']);
Route::get('adminnews', [AdminController::class, 'adminnews']);
Route::get('/adminusers', [AdminController::class, 'adminusers']);
Route::get('/adminadmins', [AdminController::class, 'adminadmins']);
Route::get('/adminlogout',[AdminController::class,'adminLogout']);
Route::post('/delete-admin',[AdminController::class,'deleteAdmin']);
Route::post('/delete-user',[AdminController::class,'deleteUser']);
Route::get('display', [AdminController::class, 'display']);
Route::post('/post', [AdminController::class, 'post']);