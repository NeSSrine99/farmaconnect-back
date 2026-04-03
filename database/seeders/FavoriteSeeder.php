<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        for($i=1; $i<=6; $i++){
            $client = User::find($i+3);
            $client->favorites()->attach([($i%6)+1, (($i+1)%6)+1]);
        }
    }
}