<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10'],
            'start_date' => ['required', 'date'],
            'birthday' => ['required', 'date'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png,gif', 'max:2048'] //2048 คือ 2 MB
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $imagepath = null;
        if (isset($data['image'])) {
            // $imagepath = $data['image']->store('public/user_images');    
            $imagepath = $data['image']->store('user_images', 'public');     //storage/app/public/user_images


        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => '0',
            'status' => '1',   //1หมายถึงเป็นพนักงาน 0 หมายถึงไม่ได้เป็นพนักงาน
            'lname' => $data['lname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'start_date' => $data['start_date'],
            'birthday' => $data['birthday'],
            'image' => $imagepath
        ]);
    }


    //หน้าสมัครสมาชิกนะ
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    //จัดการโปรไฟล์
    public function profile()
    {
        $adm = auth()->user();
        return view('admin.profile', compact('adm'));
    }




    public function updateprofile(Request $request, User $user)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'lname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'birthday' => 'required|date',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $input['image'] = $request->file('image')->store('user_images', 'public');
        }
        $user->update($input);
        return redirect()->back()->with('success', 'แก้ไขสำเร็จแล้ว');
    }


    //แสดงพนักงาน
    public function showEmployee()
    {
        $employee = User::paginate(10);
        return view('admin.ShowEmployee', compact('employee'));
    }





    //ดูรายละเอียดพนักงานโดยเข้าถึงโดย id
    public function EmployeeDetail($id)
    {
        $employeefind = User::findOrFail($id);
        return view('admin.EmployeeDetail', compact('employeefind'));
    }




    public function changeStatus($id)
    {
        $employee = User::findOrFail($id);
        if ($employee->status == 1) {
            $employee->status = 0;
        } elseif ($employee->status == 0) {
            $employee->status = 1;
        }
        $employee->save();
        return redirect()->back()->with('success', "สำเร็จแล้ว");
    }

    //เปลี่ยนรหัสผ่าน
    public function changepassword(){
        $adm = auth()->user();
        return view('admin.changepassword',compact('adm')); 
    }

    //อัปเดตรหัสผ่าน
    public function password_action(Request $request){
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'กรุณากรอกรหัสผ่านเดิม',
            'old_password.current_password' => 'รหัสผ่านเดิมไม่ถูกต้อง',
            'new_password.required' => 'กรุณากรอกรหัสผ่านใหม่',
            'new_password.confirmed' => 'รหัสผ่านใหม่และการยืนยันรหัสผ่านไม่ตรงกัน',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return redirect()->back()->with('success','เปลี่ยนรหัสผ่านสำเร็จ') ; 
    }



}
