<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DressController;
use App\Http\Controllers\Employee\CreateOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewdressController;
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

    // Route::get('/admin/showaccessory', [AccessoryController::class, 'showAccessory'])->name('admin.showAccessory'); //แสดงเครื่องประดับ
    // Route::get('/admin/filterAccessory', [AccessoryController::class, 'showAccessory'])->name('admin.filterAccessory');

    // Route::get('/admin/detailaccessory/{id}', [AccessoryController::class, 'detailAccessory'])->name('admin.detailAccessory'); //แสดงรายละเอียดเครื่องประดับ

    // Route::get('/admin/editaccessory/{id}', [AccessoryController::class, 'editAccessory'])->name('admin.editAccessory'); //หน้าแก้ไข
    // Route::post('/admin/updateaccessory/{id}', [AccessoryController::class, 'updateAccessory'])->name('admin.updateAccessory'); //หน้าอัปเดต


    // Route::get('/admin/showaccessory/{filterAccessory?}', [AccessoryController::class, 'showAccessory'])->name('admin.showAccessory');
    // Route::get('/admin/showaccessory/{filterAccessory?}', [AccessoryController::class, 'showAccessory'])->name('admin.showAccessory');









    //ชุด
    // Route::get('/admin/dress/create', [DressController::class, 'formdress'])->name('admin.formdress'); //แบบฟอร์มเพิ่มชุด
    // Route::post('/admin/storedress', [DressController::class, 'storeDress'])->name('admin.sotre'); // บันทึกนะ
    // Route::get('/admin/dresscodes/{dressType}', [DressController::class, 'getDressCodes']); //ไปดึงรหัสชุด


    // Route::get('/admin/numbercodes/{numbertypecode}', [DressController::class, 'NumberCodes']);

    // Route::get('/admin/sizes/{dressType}/{dressCode}', [DressController::class, 'getSizeNames']); //ดึงไซส์

    // Route::get('/admin/image/{dressType}/{dressCode}', [DressController::class, 'getimage']);  //ดึงรูปภาพ

    // Route::get('/admin/getdes/{dressType}/{dressCode}', [DressController::class, 'getDescription']); //ดึงdescription
    
    //คอมเม้นโค้ดส่วนเดิมไว้


    Route::get('/admin/showdress', [DressController::class, 'showDress'])->name('admin.showDress');   //แสดงชุดทั้งหมดในร้าน

    Route::get('/admin/detaildress/{id}', [DressController::class, 'detailDress'])->name('admin.detailDress');   // แสดงรายละเอียดชุด
    Route::get('/admin/editdress/{id}', [DressController::class, 'editDress'])->name('admin.editDress');   // หน้าแก้ไขชุด
    Route::post('/admin/updatedress/{id}', [DressController::class, 'updateDress'])->name('admin.updateDress'); //หน้าอัปเดต

    Route::post('admin/deletesize/{id}',[DressController::class,'deletesize'])->name('deletesize'); //ยืนยันการลบไซส์





    //ทำใหม่นะ ?  ชุดนะ 
    Route::get('/new/adddress', [DressController::class, 'getdresstype'])->name('admin.getdresstype'); //แบบฟอร์ฒเพิ่มชุด
    Route::get('/getmaxcode/{dresstype}', [DressController::class, 'getmaxcode'])->name('new.getmaxcode'); //ดึงค่ามากที่สุด + 1 
    Route::post('/saveadddress', [DressController::class, 'saveadddress'])->name('new.saveadddress'); //บันทึก

    Route::get('/admin/showdresstotal', [DressController::class, 'show'])->name('admin.showdresstotal'); //แสดงข้อมูลชุด
    Route::get('/admin/showdressdetail/{id}', [DressController::class, 'showdetail'])->name('admin.showdressdetail'); //รายละเอยีดชุด

    Route::post('/savesize', [DressController::class, 'savesize'])->name('admin.savesize'); //บันทึกไซส์

    Route::post('/updatedress', [DressController::class, 'updatefordress'])->name('admin.updatedress'); //บันทึกค่าที่แก้ไขในตาราง dress      

    Route::post('/updatepricegroup', [DressController::class, 'updatepricegroup'])->name('admin.updatepricegroup'); //บันทึกค่าที่แก้ไขในตาราง size     





    //ทำใหม้นะ ? เครื่องประดับ
    Route::get('/admin/access', [AccessoryController::class, 'showAccessories'])->name('admin.showAccessories'); //หน้าโชทั้งหมด
    Route::get('/admin/accessdetail/{id}', [AccessoryController::class, 'accessdetail'])->name('admin.accessdetail'); //แสดงรายละเอียด
    Route::post('/admin/updateaccessdetail', [AccessoryController::class, 'updateaccessdetail'])->name('admin.updateaccessdetail'); //อัปเดต
    Route::post('admin/deleteaccessory/{id}',[AccessoryController::class,'deleteaccessory'])->name('deleteaccessory') ; //ยืนยันการลบนะ 
























    Route::get('/test', function () {
        return view('admin.profilecopy');
    });
});



//สำหรับพนักงานและแอดมิน
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/homepage',[HomeController::class,'homepage'])->name('homepage') ; // หน้าแรก
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









    Route::post('/addcost', [CreateOrderController::class, 'addcost'])->name('addcost'); // เพิ่ม cost


    Route::post('/adddecoration/{orderdetailid}', [CreateOrderController::class, 'adddecoration'])->name('adddecoration'); //เพิ่มdecoration

    Route::post('/addimage', [CreateOrderController::class, 'addimage'])->name('addimage'); //เพิ่มรูปภาพ
    Route::get('/manageimage/{id}', [CreateOrderController::class, 'manageimage'])->name('manageimage'); //จัดการรูปภาพ

    Route::delete('/deleteimage/{id}', [CreateOrderController::class, 'deleteimage'])->name('deleteimage');  //ลบรูปภาพ



    //cost
    Route::post('/updatecost/{id}', [CreateOrderController::class, 'updatecost'])->name('updatecost'); //อัพเดตcost
    Route::delete('/deletecost/{id}', [CreateOrderController::class, 'deletecost'])->name('deletecost');  //ลบcost

    //decoration
    Route::post('/updatedecoration/{id}', [CreateOrderController::class, 'updatedecoration'])->name('updatedecoration'); //อัพเดตdecpration4
    Route::delete('/deletedecoration/{id}', [CreateOrderController::class, 'deletedecoration'])->name('deletedecoration'); //ลบdecpration4

    //fitting
    Route::post('/updatefitting/{id}', [CreateOrderController::class, 'updatefitting'])->name('updatefitting'); //อัพเดต fitting 
    Route::delete('/deletefitting/{id}', [CreateOrderController::class, 'deletefitting'])->name('deletefitting'); //ลบ fitting 

    

    //เพิ่มวันที่แก้ไขชุด
    Route::post('/adddate', [CreateOrderController::class, 'adddate'])->name('adddate'); //เพิ่มวันที่

    //อัปเดตสถานะกำลังเช่า
    Route::post('/updateorderstatus', [CreateOrderController::class, 'updateorderstatus'])->name('updateorderstatus'); // orderdetailอัปเดตสถานะกำลังเช่า
    //อัปเดตสถานะคืนชุดแล้ว
    Route::post('/updateorderreturn', [CreateOrderController::class, 'updateorderreturn'])->name('updateorderreturn'); // orderdetail อัปเดตสถานะคืนชุดแล้ว


    Route::get('/showorder', [CreateOrderController::class, 'showorder'])->name('showorder'); //แสดง ตาราง บิลนะ 
    Route::get('/showorder/{id}', [CreateOrderController::class, 'showorderbill'])->name('showorderbill'); //แสดงตารางorderbill



    Route::get('/totaldress', [CreateOrderController::class,'totaldress'])->name('totaldress') ; //แสดงชุดทั้งหมดสำหรับพนักงาน
    Route::get('/totaldress/detail/{id}', [CreateOrderController::class,'totaldressdetail'])->name('totaldressdetail'); //แสดงรายละเอียดชุด
});




Route::get('/testlogin', function () {
    return view('test');
});

Route::get('/t', function () {
    return view('employee.t');
});



