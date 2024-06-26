<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeletePersonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_delete_person_by_id(): void
    {
        // $response = $this->get('/');
        $person =  Person::factory() -> create();
        $response = $this->delete(route('persons.delete', $person->id));
        $response->assertStatus(200);
    }
    /** @test */
    public function user_cannt_delete_person_if_person_dont_exists()
    {
        $id = -1;
        $response = $this->delete(route('persons.delete',$id));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

}
