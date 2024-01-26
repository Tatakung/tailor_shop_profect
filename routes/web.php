<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//เฉพาะแอดมิน
Route::middleware(['web', 'is_admin'])->group(function () {
    Route::get('admin/home',[HomeController::class,'adminHome'])->name('admin.home');//หลังจากล็อคอิน
    Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');//สมัครสมาชิก
    Route::get('/admin/profile',[RegisterController::class,'profile'])->name('admin.profile');//แก้ไขโปรไฟล์
    Route::post('/admin/profile/updateprofile/{user}',[RegisterController::class,'updateprofile'])->name('admin.updateprofile');//แก้ไขโปรไฟล์

    //พนักงาน
    Route::get('/admin/showemployee',[RegisterController::class,'showEmployee'])->name('admin.showEmployee');//แสดงพนักงาน
    Route::get('/admin/employeedetail/{id}',[RegisterController::class,'EmployeeDetail'])->name('admin.employeedetail');//แสดงรายละเอียดพนักงาน



    Route::get('/admin/changestatus/{id}',[RegisterController::class,'changeStatus'])->name('admin.changestatus');//เปลี่ยนสถานะพนักงานนะ



    Route::get('/test', function () {
    return view('admin.profilecopy');
});

    





});



//สำหรับพนักงานและแอดมิน
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile/edit',[ProfileController::class,'EditProfile'])->name('profile.edit');//จัดการโปรไฟล์
    Route::post('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');
});