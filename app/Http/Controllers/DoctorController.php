<?php

// app/Http/Controllers/DoctorController.php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Login;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Thêm bác sĩ
    public function addDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cccd' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'address' => 'required',
            'sex' => 'required',
            'birthday' => 'required|date',
            'brandID' => 'required',
            'password' => 'required'
        ]);

        $doctor = Doctor::create($request->all());

        // Lưu thông tin đăng nhập
        Login::create([
            'username' => $doctor->username,
            'password' => bcrypt($request->password),
            'role' => 1 // 1: doctor
        ]);

        return response()->json($doctor, 201);
    }

    // Đổi mật khẩu
    public function changePassword(Request $request, $id)
    {
        $request->validate(['new_password' => 'required']);

        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $login = Login::where('username', $doctor->username)->first();
        $login->password = bcrypt($request->new_password);
        $login->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    // Đổi thông tin
    public function updateDoctor(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        $doctor->update($request->all());
        return response()->json($doctor, 200);
    }
}
