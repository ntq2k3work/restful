<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreatePersonTest extends TestCase
{

    public function test_user_can_create_person_record_when_fill_fully(): void
    {
        $person = [
            'FirstName' => fake() -> FirstName,
            'LastName' => fake() ->LastName,
            'Address' => fake() ->Address,
            'City' => fake() ->City,
        ];
        $response = $this->json('POST',route('persons.store',$person));
        $response->assertStatus(Response::HTTP_OK);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('status') -> has('message') -> has('data')
        );
    }
    public function test_user_dont_fill_firstName(): void
    {
        $person = [
            'LastName' => fake() ->LastName,
            'Address' => fake() ->Address,
            'City' => fake() ->City,
        ];
        $response = $this->json('POST',route('persons.store',$person));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('errors')
        );
    }
    public function test_user_dont_fill_lastName(): void
    {
        $person = [
            'FirstName' => fake() ->FirstName,
            'Address' => fake() ->Address,
            'City' => fake() ->City,
        ];
        $response = $this->json('POST',route('persons.store',$person));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('errors')
        );
    }
    public function test_user_dont_fill_address(): void
    {
        $person = [
            'LastName' => fake() ->LastName,
            'FirstName' => fake() ->FirstName,
            'City' => fake() ->City,
        ];
        $response = $this->json('POST',route('persons.store',$person));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('errors')
        );
    }
    public function test_user_dont_fill_city(): void
    {
        $person = [
            'LastName' => fake() ->LastName,
            'FirstName' => fake() ->FirstName,
            'Address' => fake() ->Address,
        ];
        $response = $this->json('POST',route('persons.store',$person));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('errors')
        );
    }
}
