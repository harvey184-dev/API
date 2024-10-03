<?php

namespace App\Http\Controllers;

use App\Models\DetailOfMedicalExaminationService;
use Illuminate\Http\Request;

class DetailOfMedicalExaminationServiceController extends Controller
{
    public function addDetail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'medicalExaminationServiceID' => 'required'
        ]);

        $detail = DetailOfMedicalExaminationService::create($request->all());
        return response()->json($detail, 201);
    }
}
