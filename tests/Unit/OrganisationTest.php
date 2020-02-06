<?php

namespace Tests\Unit;

use App\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganisationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_an_id()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();
        $this->assertNotNull($organisation->id);
    }

    /** @test */
    public function it_has_a_name()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();
        $this->assertNotNull($organisation->name);
    }

    /** @test */
    public function it_has_timestamps()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();
        $this->assertNotNull($organisation->created_at);
        $this->assertNotNull($organisation->updated_at);
    }
}
