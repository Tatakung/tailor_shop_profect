<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DressController;
use App\Http\Controllers\Employee\CreateOrderController;
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
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home'); //หลังจากล็อคอิน
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register'); //สมัครสมาชิก
    Route::get('/admin/profile', [RegisterController::class, 'profile'])->name('admin.profile'); //แก้ไขโปรไฟล์
    Route::post('/admin/profile/updateprofile/{user}', [RegisterController::class, 'updateprofile'])->name('admin.updateprofile'); //แก้ไขโปรไฟล์

    //พนักงาน
    Route::get('/admin/showemployee', [RegisterController::class, 'showEmployee'])->name('admin.showEmployee'); //แสดงพนักงาน
    Route::get('/admin/employeedetail/{id}', [RegisterController::class, 'EmployeeDetail'])->name('admin.employeedetail'); //แสดงรายละเอียดพนักงาน
    Route::get('/admin/changestatus/{id}', [RegisterController::class, 'changeStatus'])->name('admin.changestatus'); //เปลี่ยนสถานะพนักงานนะ


    //เครื่องประดับ
    Route::get('/admin/accessory/create', [AccessoryController::class, 'formaccessory'])->name('admin.formaccessory'); //แบบฟอร์มเพิ่มเครื่องประดับ
    Route::post('/admin/storeaccessory', [AccessoryController::class, 'store'])->name('admin.store'); //บันทึก

    Route::get('/getCode/{accessory_name}', [AccessoryController::class, 'getMaxAccessoryCode']);

    Route::get('/admin/showaccessory', [AccessoryController::class, 'showAccessory'])->name('admin.showAccessory'); //แสดงเครื่องประดับ
    Route::get('/admin/filterAccessory', [AccessoryController::class, 'showAccessory'])->name('admin.filterAccessory');

    Route::get('/admin/detailaccessory/{id}', [AccessoryController::class, 'detailAccessory'])->name('admin.detailAccessory'); //แสดงรายละเอียดเครื่องประดับ

    Route::get('/admin/editaccessory/{id}', [AccessoryController::class, 'editAccessory'])->name('admin.editAccessory'); //หน้าแก้ไข
    Route::post('/admin/updateaccessory/{id}', [AccessoryController::class, 'updateAccessory'])->name('admin.updateAccessory'); //หน้าอัปเดต


    // Route::get('/admin/showaccessory/{filterAccessory?}', [AccessoryController::class, 'showAccessory'])->name('admin.showAccessory');
    // Route::get('/admin/showaccessory/{filterAccessory?}', [AccessoryController::class, 'showAccessory'])->name('admin.showAccessory');









    //ชุด
    Route::get('/admin/dress/create', [DressController::class, 'formdress'])->name('admin.formdress'); //แบบฟอร์มเพิ่มชุด
    Route::post('/admin/storedress', [DressController::class, 'storeDress'])->name('admin.sotre'); // บันทึกนะ
    Route::get('/admin/dresscodes/{dressType}', [DressController::class, 'getDressCodes']); //ไปดึงรหัสชุด


    Route::get('/admin/numbercodes/{numbertypecode}', [DressController::class, 'NumberCodes']);

    Route::get('/admin/sizes/{dressType}/{dressCode}', [DressController::class, 'getSizeNames']); //ดึงไซส์

    Route::get('/admin/image/{dressType}/{dressCode}', [DressController::class, 'getimage']);  //ดึงรูปภาพ

    Route::get('/admin/getdes/{dressType}/{dressCode}', [DressController::class, 'getDescription']); //ดึงdescription

    Route::get('/admin/showdress', [DressController::class, 'showDress'])->name('admin.showDress');   //แสดงชุดทั้งหมดในร้าน

    Route::get('/admin/detaildress/{id}', [DressController::class, 'detailDress'])->name('admin.detailDress');   // แสดงรายละเอียดชุด
    Route::get('/admin/editdress/{id}', [DressController::class, 'editDress'])->name('admin.editDress');   // หน้าแก้ไขชุด
    Route::post('/admin/updatedress/{id}', [DressController::class, 'updateDress'])->name('admin.updateDress'); //หน้าอัปเดต







    Route::get('/test', function () {
        return view('admin.profilecopy');
    });
});



//สำหรับพนักงานและแอดมิน
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'EditProfile'])->name('profile.edit'); //จัดการโปรไฟล์
    Route::post('/profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('/createorder', [CreateOrderController::class, 'formcreate'])->name('formcreate'); //แบบฟอร์มเช่าชุด
    Route::get('/getdresscode/{dressType}', [CreateOrderController::class, 'getDressCodes']); //ไปดึงรหัสชุด
    Route::get('/get/sizename/{selecttype}/{selectcode}', [CreateOrderController::class, 'getsizename']); //ไปดึงไซส์มาา
    Route::get('/get/image/{selecttype}/{selectcode}', [CreateOrderController::class, 'getimage']); //ไปดึงรูปชุดมา
    Route::get('/get/pricedeposit/{selecttype}/{selectcode}/{selectsize}', [CreateOrderController::class, 'getprice']);

    Route::post('/order', [CreateOrderController::class, 'store'])->name('order.store'); //เพิ่มเช่าชุด

    Route::get('/showrent', [CreateOrderController::class, 'showTable'])->name('showrent'); //เพิ่มเช่าชุด
    Route::get('/rentdetail/{id}', [CreateOrderController::class, 'rentdetail'])->name('rentdetail'); //รายละเอียดเช่าชุดนะ orderdetail



    Route::post('/addfitting/{orderdetailid}', [CreateOrderController::class, 'addfitting'])->name('addfitting'); //เพิ่มfitting

    //แก้ไข fitting
    Route::get('/editfitting/{id}', [CreateOrderController::class, 'editfitting'])->name('editfitting'); //หน้าแก้ไข fitting 
    Route::post('/updatefitting/{id}', [CreateOrderController::class, 'updatefitting'])->name('updatefitting'); //อัพเดต fitting 
    Route::get('/deletefitting/{id}', [CreateOrderController::class, 'deletefitting'])->name('deletefitting'); //ลบ fitting 




    //แก้ไข Decoration 
    Route::get('/editdecoration/{id}', [CreateOrderController::class, 'editdecoration'])->name('editdecoration'); //หน้าแก้ไข decoration
    Route::post('/updatedecoration/{id}', [CreateOrderController::class, 'updatedecoration'])->name('updatedecoration'); // อัพเดต decoration
    Route::get('/deletedecoration/{id}', [CreateOrderController::class, 'deletedecoration'])->name('deletedecoration'); // ลบ decoration




    Route::post('/addcost', [CreateOrderController::class, 'addcost'])->name('addcost'); // เพิ่ม cost
    Route::get('/editcost/{id}', [CreateOrderController::class, 'editcost'])->name('editcost'); // หน้าแก้ไข cost 
    Route::post('/updatecost/{id}', [CreateOrderController::class, 'updatecost'])->name('updatecost'); //อะพเดตcost

    Route::get('/deletecost/{id}', [CreateOrderController::class, 'deletecost'])->name('deletecost'); //ลบ cost
    // Route::get('/dress/softdelete/{id}', [DressmanageController::class, 'softdeleteDress'])->name('dress.softdelete'); //ลบชุดแบบsoftdelete


    Route::post('/adddecoration/{orderdetailid}', [CreateOrderController::class, 'adddecoration'])->name('adddecoration'); //เพิ่มdecoration


    Route::post('/addimage', [CreateOrderController::class, 'addimage'])->name('addimage'); //เพิ่มรูปภาพ
    Route::get('/manageimage/{id}', [CreateOrderController::class, 'manageimage'])->name('manageimage'); //จัดการรูปภาพ




});


Route::get('/testlogin', function () {
    return view('test');
});
