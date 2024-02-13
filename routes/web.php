<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerificationMiddleware;





// Page Routes
Route::get('/',[HomeController::class,'HomePage']);
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile',[UserController::class,'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/categoryPage',[CategoryController::class,'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customerPage',[CustomerController::class,'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/productPage',[ProductController::class,'ProductPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/invoicePage',[InvoiceController::class,'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/salePage',[InvoiceController::class,'SalePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/reportPage',[ReportController::class,'ReportPage'])->middleware([TokenVerificationMiddleware::class]);





//User Authentication API Route
Route::post('/user-registration', [UserController::class,'UserRegistration']);
Route::post('/user-login', [UserController::class,'UserLogin']);
Route::get('/user-logout', [UserController::class,'UserLogout'])->middleware(TokenVerificationMiddleware::class);
Route::post('/send-OTP', [UserController::class,'SendOTPCode']);
Route::post('/verify-OTP', [UserController::class,'VerifyOTP']);
Route::post('/reset-password', [UserController::class,'ResetPassword'])->middleware(TokenVerificationMiddleware::class);



//user profile and profile update API Route
Route::get('/user-profile', [UserController::class,'UserProfile'])->middleware(TokenVerificationMiddleware::class);
Route::post('/update-profile', [UserController::class,'UpdateProfile'])->middleware(TokenVerificationMiddleware::class);


//category API Route
Route::post('/category-create', [CategoryController::class,'CategoryCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/category-list', [CategoryController::class,'CategoryList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-delete', [CategoryController::class,'CategoryDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-by-id', [CategoryController::class,'CategoryByID'])->middleware(TokenVerificationMiddleware::class);
Route::post('/category-update', [CategoryController::class,'CategoryUpdate'])->middleware(TokenVerificationMiddleware::class);



//customers API Route
Route::post('/customer-create', [CustomerController::class,'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/customer-list', [CustomerController::class,'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-delete', [CustomerController::class,'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-by-id', [CustomerController::class,'CustomerById'])->middleware(TokenVerificationMiddleware::class);
Route::post('/customer-update', [CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);



//prducts API Route
Route::get('/product-list', [ProductController::class,'ProductList'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-create', [ProductController::class,'ProductCreate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-delete', [ProductController::class,'DeleteProduct'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-by-id', [ProductController::class,'ProductByID'])->middleware(TokenVerificationMiddleware::class);
Route::post('/product-update', [ProductController::class,'UpdateProduct'])->middleware(TokenVerificationMiddleware::class);



//invoice API Route
Route::post('/invoice-create', [InvoiceController::class,'InvoiceCreate'])->middleware(TokenVerificationMiddleware::class);
Route::post('/invoice-delete', [InvoiceController::class,'invoiceDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post('/invoice-details', [InvoiceController::class,'InvoiceDetails'])->middleware(TokenVerificationMiddleware::class);
Route::get('/invoice-select', [InvoiceController::class,'invoiceSelect'])->middleware(TokenVerificationMiddleware::class);



// SUMMARY & Report
Route::get("/summary",[DashboardController::class,'Summary'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/sales-report/{FormDate}/{ToDate}",[ReportController::class,'SalesReport'])->middleware([TokenVerificationMiddleware::class]);

//

