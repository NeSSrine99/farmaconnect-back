<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    // Upload prescription
    public function store(Request $request)
    {
        $path = $request->file('file')->store('prescriptions');

        $prescription = Prescription::create([
            'user_id' => $request->user_id,
            'file' => $path,
            'status' => 'pending'
        ]);

        return response()->json($prescription, 201);
    }

    // Pharmacist review
    public function review(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);

        $prescription->update([
            'status' => $request->status, // approved / rejected
            'reviewed_by' => $request->reviewed_by
        ]);

        return response()->json($prescription);
    }
}
