<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetListPersonTest extends TestCase
{
    /** @test */
    public function get_list_person(): void
    {
        $personCount = Person::count();
        $response = $this->get(route('persons.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response -> assertJson(fn (AssertableJson $json) =>
            $json -> has('data',fn (AssertableJson $json) =>
                $json -> has('links', fn(AssertableJson $json) =>
                    $json -> has('first') -> etc()
                ) -> has('meta',fn (AssertableJson $json) =>
                    $json->where('total',$personCount)-> etc()
                ) -> etc()
            )-> etc()
        );
    }
}
