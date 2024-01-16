<?php

use App\Http\Controllers\Admin\CategoryEventController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EvenementController;
use App\Http\Controllers\Admin\NomineController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

////////////////////////// User Login API Start /////////////////////////////////////

//Login route
Route::post('/login', [AuthController::class, 'Login']);
//Register route
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
//Forget password route
Route::post('/forgetpassword', [ForgetController::class, 'ForgetPassword']);
//Reset password route
Route::post('/resetpassword', [ResetController::class, 'ResetPassword']);
//Current User route: ceci permet de recuperer les infos de l'utilisateur connecté
Route::get('/user', [UserController::class, 'User'])->middleware('auth:api');

////////////////////////// User Login API END ///////////////////////////////////////

//Get visitor 
Route::get('/getvisitor', [VisitorController::class, 'GetVisitorDetails']);
//Contact page Route
Route::post('/postcontact', [ContactController::class, 'PostContactDetails']);

//Site Info Route
Route::get('/allsiteinfo', [SiteInfoController::class, 'AllSiteInfo']);
//All Event Route
Route::get('/allevent', [EvenementController::class, 'AllEvent']);
//All Event Category Route
Route::get('/alleventcategory/{id}', [CategoryEventController::class, 'AllEventCategory']);
//All Nomine by event Route
Route::get('/nominebyevent/{id}', [NomineController::class, 'NomineByEvent']);
//All Nomine by Category Route
Route::get('/nominebycategory/{evenement_id}/{categoryevent_id}', [NomineController::class, 'NomineByCategory']);
//All Nomine specifique Route
Route::get('/nominedetails/{id}', [NomineController::class, 'NomineDetails']);
//All payment Route
Route::post('/payvote/{event_id}/{id}', [PaymentController::class, 'payVote']);

////////////////////////// GESTION DES NOMINES ///////////////////////////////////////
// Route::get('eventcrenomine/{email}', [NomineController::class, 'recupEvent']);
// Route::get('cateventcrenomine/{email}/{id}', [NomineController::class, 'recupEventCateg']);
Route::post('addnomine/{id}', [NomineController::class, 'Nominecree']);
Route::post('lognomine', [NomineController::class, 'logNomine']);
Route::get('nominepart/{email}', [NomineController::class, 'NomineAuth']);

////////////////////////// GESTION DES CATEGORY D'EVENEMENT ///////////////////////////////////////
Route::get('alleventcategoryuser/{email}/{id}', [CategoryEventController::class, 'AllCategoryEventByUser']);
Route::post('addeventcategory/{id}', [CategoryEventController::class, 'creerCategoryEvent']);
Route::get('showeventcategory/{id}', [CategoryEventController::class, 'showCategoryEvent']);

////////////////////////// GESTION DES EVENEMENTS ///////////////////////////////////////
Route::get('alleventuser/{email}', [EvenementController::class, 'AllEventByUser']);
Route::post('addevent', [EvenementController::class, 'CreerEvent']);
Route::get('show/{id}', [EvenementController::class, 'showEvent']);