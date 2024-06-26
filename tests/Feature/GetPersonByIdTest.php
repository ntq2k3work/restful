<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
class GetPersonByIdTest extends TestCase
{
    /**
     * @test
     */
    public function get_person_by_id(): void
    {
        $person = Person::factory() -> create();
        $response = $this->get(route('persons.show',$person -> id));
        $response->assertStatus(Response::HTTP_OK);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('data',fn (AssertableJson $json) =>
                $json -> where('id',$person -> id) -> etc()
            )-> etc()
        );
    }
    /** @test */
    public function get_person_by_id_which_isnt_exist()
    {
        $id = -1;
        $response = $this->get(route('persons.show',$id));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> where('status',Response::HTTP_NOT_FOUND) -> has('message')
    );
    }
}
