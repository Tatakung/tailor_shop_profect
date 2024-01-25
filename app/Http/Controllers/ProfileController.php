<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function EditProfile(){
        return view('employee.profile',['emp' => auth()->user()]);
    }

    
public function update(Request $request, User $user)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'address' => 'required|string',
            'birthday' => 'required|date',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        
        if ($request->hasFile('image')){
            $input['image'] = $request->file('image')->store('user_images','public'); 
        }
        
        $user->update($input);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }







    
}
