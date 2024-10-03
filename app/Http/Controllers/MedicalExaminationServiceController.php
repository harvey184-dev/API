<?php

namespace App\Http\Controllers;

use App\Models\MedicalExaminationService;
use Illuminate\Http\Request;

class MedicalExaminationServiceController extends Controller
{
    public function addService(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'medicalRecordID' => 'required'
        ]);

        $service = MedicalExaminationService::create($request->all());
        return response()->json($service, 201);
    }
}
