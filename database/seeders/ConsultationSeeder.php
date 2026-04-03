<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultation;

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        for($i=1; $i<=6; $i++){
            Consultation::create([
                'user_id' => $i+3,
                'pharmacien_id' => ($i%2)+2, // alternating pharmacist
                'message' => "Hello, I want advice for my health issue #$i.",
                'reply' => "Advice from Pharmacien for client #$i."
            ]);
        }
    }
}