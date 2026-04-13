<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::get('/userForm', [UserController::class, 'userForm']);
Route::post('/userRegister',[UserController::class, 'register']);
Route::post('/userLogin',[UserController::class, 'login']);




Route::middleware('auth401')->group(function(){

    Route::post('/userLogout', [UserController::class, 'logout']);
    Route::get('/me', [UserController::class, 'edit']);
    Route::put('/profile/update', [UserController::class, 'update']);
    Route::put('/profile/removeAvatar', [UserController::class, 'removeAvatar']);

});




Route::get('/login', function () {
    return view('auth.login');
});

// Public Facing Page: 
Route::get('/', [ProductController::class, 'getProductsPublic']);
Route::get('01/{product:gtin}', [ProductController::class, 'getProductPublic']);


//Bulk Validation
Route::get('/verify', function(){
    return view('publicProducts.verify');
});
Route::post('/verify', [ProductController::class, 'verifyGTINs']);




//Route for JSON
Route::get('products.json', [ProductController::class, 'getProductsJson']);
ROute::get('products/{product:gtin}.json',[ProductController::class, 'getProductJson']);


Route::post('/login',[LoginController::class, 'login']);

Route::middleware('admin401')->group(function(){

    //Route for logout:
    Route::post('/logout',[LoginController::class,'logout']);
    // Route for companies: 
    Route::get('/companies',[CompanyController::class, 'index']);
    Route::get('/companies/{company}/show', [CompanyController::class, 'show']);
    Route::get('/companies/create',[CompanyController::class, 'create']);
    Route::post('/companies/create',[CompanyController::class, 'store']);
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit']);
    Route::put('/companies/{company}', [CompanyController::class, 'update']);
    Route::post('companies/{company}/deactivate',[CompanyController::class, 'deactivate']);
    
    //Route for products:
    Route::get('/products',[ProductController::class, 'index']);
    Route::get('/products/{product:gtin}/show', [ProductController::class, 'show']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products/store', [ProductController::class, 'store']);
    Route::get('/products/{product:gtin}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{product:gtin}/update', [ProductController::class, 'update']);

    Route::put('/products/{product:gtin}/changeImage', [ProductController::class, 'changeImage']);
    Route::put('/products/{product:gtin}/removeImage', [ProductController::class, 'removeImage']);
    Route::put('/products/{product:gtin}/hide', [ProductController::class, 'hideProduct']);
    Route::delete('/products/{product:gtin}/destroy', [ProductController::class, 'destroy']);

    //Route for categories:
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{category}/update', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy']);






    

});

