<?php

// app/Http/Controllers/BranchController.php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Thêm chi nhánh
    public function addBranch(Request $request, $hospitalId)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'address' => 'required'
        ]);

        $branch = Branch::create(array_merge($request->all(), ['hospitalID' => $hospitalId]));
        return response()->json($branch, 201);
    }

    // Sửa chi nhánh
    public function updateBranch(Request $request, $id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Branch not found'], 404);
        }
        $branch->update($request->all());
        return response()->json($branch, 200);
    }

    // Xóa chi nhánh
    public function deleteBranch($id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Branch not found'], 404);
        }
        $branch->delete();
        return response()->json(['message' => 'Branch deleted successfully'], 200);
    }

    // Hiện thị chi tiết chi nhánh: tất cả bác sĩ trong chi nhánh
    public function getBranchDetails($id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Branch not found'], 404);
        }
        return response()->json($branch, 200); // Cần thêm logic lấy bác sĩ
    }
}

