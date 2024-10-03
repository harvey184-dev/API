<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicalExaminationServiceController;
use App\Http\Controllers\DetailOfMedicalExaminationServiceController;
use App\Http\Controllers\AuthController;

Route::post('/hospitals', [HospitalController::class, 'addHospital']);
Route::get('/hospitals', [HospitalController::class, 'getAllHospitals']);
Route::get('/hospitals/{id}', [HospitalController::class, 'getHospitalDetails']);
Route::put('/hospitals/{id}/password', [HospitalController::class, 'changePassword']);
Route::put('/hospitals/{id}', [HospitalController::class, 'updateHospital']);

Route::post('/hospitals/{hospitalId}/branches', [BranchController::class, 'addBranch']);
Route::put('/branches/{id}', [BranchController::class, 'updateBranch']);
Route::delete('/branches/{id}', [BranchController::class, 'deleteBranch']);
Route::get('/branches/{id}', [BranchController::class, 'getBranchDetails']);

Route::post('/doctors', [DoctorController::class, 'addDoctor']);
Route::put('/doctors/{id}/password', [DoctorController::class, 'changePassword']);
Route::put('/doctors/{id}', [DoctorController::class, 'updateDoctor']);
Route::get('/doctors/{id}', [DoctorController::class, 'show']);

Route::post('/medical-records', [MedicalRecordController::class, 'addMedicalRecord']);
Route::get('/patients/{cccdPatient}/medical-records', [MedicalRecordController::class, 'viewMedicalRecords']);
Route::get('/medical-records/{id}', [MedicalRecordController::class, 'getMedicalRecordDetails']);

Route::post('/medical-examination-services', [MedicalExaminationServiceController::class, 'addService']);

Route::post('/details-of-medical-examination-services', [DetailOfMedicalExaminationServiceController::class, 'addDetail']);

Route::post('/login', [AuthController::class, 'login']);
