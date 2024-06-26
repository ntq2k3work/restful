<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UpdatePersonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_update_when_fill_full_field(): void
    {
        $updated = [
            'FirstName' => fake()-> FirstName,
            'LastName' => fake() -> LastName,
            'Address' => fake() -> Address,
            'Email' => fake() -> Email
        ];
        $person = Person::factory()->create();
        $response = $this->put(route('persons.update',$person->id),$updated);
        $response->assertStatus(Response::HTTP_OK);
    }
    public function test_user_update_when_not_fill_full_field()
    {
        $updated = [
            'FirstName' => fake()-> FirstName,
            'LastName' => fake() -> LastName,
            'Address' => fake() -> Address,
        ];
        $person = Person::factory()->create();
        $response = $this->patch(route('persons.update',$person->id),$updated);

        $response->assertStatus(Response::HTTP_OK);

        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('data',fn (AssertableJson $json) =>
                $json->where('id',$person->id) -> where('FirstName',$updated['FirstName']) -> etc()
            )->etc()
    );
    }
    public function test_dont_fill_id()
    {
        $id = -1;
        $response = $this->patch(route('persons.update',$id));
        $response->assertStatus(Response::HTTP_NOT_FOUND);

    }
}
