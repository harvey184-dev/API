<?php

// app/Http/Controllers/MedicalRecordController.php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\MedicalExaminationService;
use App\Models\DetailOfMedicalExaminationService;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // Thêm bệnh án
    public function addMedicalRecord(Request $request)
    {
        $request->validate([
            'doctorID' => 'required',
            'hospitalID' => 'required',
            'name' => 'required',
            'result' => 'required',
            'cccdPatient' => 'required',
            'services' => 'required|array',
        ]);

        $medicalRecord = MedicalRecord::create($request->all());

        foreach ($request->services as $service) {
            $examinationService = MedicalExaminationService::create([
                'name' => $service['name'],
                'desc' => $service['desc'],
                'medicalRecordID' => $medicalRecord->_id,
            ]);

            foreach ($service['details'] as $detail) {
                DetailOfMedicalExaminationService::create([
                    'name' => $detail['name'],
                    'desc' => $detail['desc'],
                    'medicalExaminationServiceID' => $examinationService->_id,
                ]);
            }
        }

        return response()->json($medicalRecord, 201);
    }

    // Xem bệnh án
    public function viewMedicalRecords($cccdPatient)
    {
        $records = MedicalRecord::where('cccdPatient', $cccdPatient)->get();
        return response()->json($records, 200);
    }

    // Xem chi tiết bệnh án
    public function getMedicalRecordDetails($id)
    {
        $record = MedicalRecord::find($id);
        if (!$record) {
            return response()->json(['message' => 'Medical record not found'], 404);
        }
        return response()->json($record, 200); // Cần thêm logic để lấy chi tiết dịch vụ
    }
}
