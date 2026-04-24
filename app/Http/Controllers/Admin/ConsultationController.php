<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // 📋 LIST
    public function index()
    {
        $consultations = Consultation::with(['user', 'pharmacien'])
            ->latest()
            ->paginate(10);

        return view('admin.consultations.index', compact('consultations'));
    }

    // 👁️ SHOW
    public function show($id)
    {
        $consultation = Consultation::with(['user', 'pharmacien'])
            ->findOrFail($id);

        return view('admin.consultations.show', compact('consultation'));
    }

    // 💬 REPLY
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $consultation = Consultation::findOrFail($id);

        $consultation->update([
            'reply' => $request->reply
        ]);

        return back()->with('success', 'Reply sent successfully');
    }

    // ❌ DELETE
    public function destroy($id)
    {
        Consultation::findOrFail($id)->delete();

        return back()->with('success', 'Consultation deleted');
    }
}
