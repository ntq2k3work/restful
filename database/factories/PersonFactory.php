<?php

namespace Database\Factories;

use App\Models\Person;
use Database\Seeders\PersonSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{


    protected $model = Person::class;
    use WithFaker;
    public function definition()
    {
        return[
            'FirstName' => $this -> faker -> FirstName,
            'LastName' => $this -> faker -> LastName,
            'Address' => $this -> faker -> Address,
            'City' => $this -> faker -> City
        ];
    }
}
