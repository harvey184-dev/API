<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Login;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function addHospital(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'username' => 'required',
            'address' => 'required',
            'password' => 'required'
        ]);

        $hospital = Hospital::create($request->all());

        Login::create([
            'username' => $hospital->username,
            'password' => bcrypt($request->password),
            'role' => 0
        ]);

        return response()->json($hospital, 201);
    }

    public function getAllHospitals()
    {
        return response()->json(Hospital::all(), 200);
    }

    public function getHospitalDetails($id)
    {
        $hospital = Hospital::find($id);
        if (!$hospital) {
            return response()->json(['message' => 'Hospital not found'], 404);
        }
        return response()->json($hospital, 200);
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate(['new_password' => 'required']);

        $hospital = Hospital::find($id);
        if (!$hospital) {
            return response()->json(['message' => 'Hospital not found'], 404);
        }

        $login = Login::where('username', $hospital->username)->first();
        $login->password = bcrypt($request->new_password);
        $login->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function updateHospital(Request $request, $id)
    {
        $hospital = Hospital::find($id);
        if (!$hospital) {
            return response()->json(['message' => 'Hospital not found'], 404);
        }
        $hospital->update($request->all());
        return response()->json($hospital, 200);
    }
}
