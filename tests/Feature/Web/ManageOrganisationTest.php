<?php

namespace Tests\Feature;

use App\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageOrganisationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_visit_all_organisations()
    {
        $this->withoutExceptionHandling();

        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();

        $this->get(route('organisations.index'))
            ->assertSee($organisation->name);
    }
}
