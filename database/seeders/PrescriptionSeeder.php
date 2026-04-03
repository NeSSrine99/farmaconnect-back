<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prescription;

class PrescriptionSeeder extends Seeder
{
    public function run(): void
    {
        for($i=1; $i<=6; $i++){
            Prescription::create([
                'user_id' => $i+3, // clients
                'file' => 'prescriptions/sample_prescription.pdf',
                'status' => 'pending',
                'reviewed_by' => 2 // Pharmacien One
            ]);
        }
    }
}