<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('user')->latest()->get();
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function updateStatus($id, $status)
    {
        $prescription = Prescription::findOrFail($id);

        $prescription->update([
            'status' => $status,
            'reviewed_by' => 1 // later: auth user
        ]);

        return back();
    }
}
