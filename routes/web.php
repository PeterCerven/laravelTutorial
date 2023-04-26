<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Controllers\ListingController;

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
// Common Resource Routes:
// index - Show all listings
// show - Show a single listing
// create - Show a form to create a new listing
// store - Save a new listing
// edit - Show a form to edit an existing listing
// update - Save an edited listing
// destroy - Delete a listing

// All listings
Route::get('/', [ListingController::class, 'index']);

// show create form
Route::get('/listings/create', [ListingController::class, 'create'])
    ->middleware('auth');


// save new listing
Route::post('/listings', [ListingController::class, 'store'])
    ->middleware('auth');

// show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth');

// Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])
    ->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth');

// Show register/create user form
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');

// Create new User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

// Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Show logging form
Route::get('/login', [UserController::class, 'login'])->name('login')
    ->middleware('guest');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])
    ->middleware('auth');

//single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);



//Route::get('/hello', function () {
//    return response('<h1>Hello World</h1>', 200)
//        ->header('Content-Type', 'text/plain')
//        ->header('foo', 'bar');
//});
//
//Route::get('/posts/{id}', function ($id) {
//    return response('Post ' . $id);
//})->where('id', '[0-9]+');
//
//Route::get('/search', function (Request $request) {
//   return $request->name . " " . $request->city;
//});
