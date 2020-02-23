<?php

namespace Tests\Unit;

use App\Organisation;
use Illuminate\Database\Eloquent\Collection;
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
    public function it_has_a_slug()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();
        $this->assertNotNull($organisation->slug);
    }

    /** @test */
    public function it_has_timestamps()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();
        $this->assertNotNull($organisation->created_at);
        $this->assertNotNull($organisation->updated_at);
    }

    /** @test */
    public function it_can_have_assigned_rooms()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();

        $this->assertInstanceOf(Collection::class, $organisation->rooms);
    }

    /** @test */
    public function it_can_have_assigned_users()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();

        $this->assertInstanceOf(Collection::class, $organisation->users);
    }

    /** @test */
    public function it_builds_routes_by_slug()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();

        $this->assertSame('slug', $organisation->getRouteKeyName());
    }

    /** @test */
    public function it_provides_its_subdomain()
    {
        $parts = parse_url(config('app.url'));
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create(['name' => 'Dummy']);
        $this->assertSame($parts['scheme'] . '://' . $organisation->slug . '.' . $parts['host'], $organisation->subdomain());
    }
}
