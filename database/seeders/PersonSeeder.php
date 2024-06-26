<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0;$i < 20;$i++){
            Person::insert([
                'FirstName' => Str::random(10),
                'LastName' => Str::random(10),
                'Address' => Str::random(10),
                'City' => Str::random(10),
            ]);
        }
    }
}
