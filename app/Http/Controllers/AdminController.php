<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Str;

class AdminController extends Controller
{
    public function AdminDashboard(Request $request)
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }
    public function AdminProfile(Request $request)
    {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.admin_profile', $data);
    }

    public function AdminProfileUpdate(Request $request)
    {
        // dd($request->all());

        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);
        $user->phone = trim($request->phone);
        $user->password = trim($request->password);
        $user->photo = trim($request->photo);
        $user->address = trim($request->address);
        $user->website = trim($request->website);
        $user->about = trim($request->about);
        $user->save();

        return redirect('admin/profile')->with('success', 'Profile Updated Successfully..');
    }
}
