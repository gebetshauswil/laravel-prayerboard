<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageOrganisationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_guest_can_not_manage_an_organisation()
    {
        /** @var Organisation $organisation */
        $organisation = factory(Organisation::class)->create();

        $this->get(route('organisations.index'))->assertRedirect(route('login'));
        $this->get(route('organisations.create'))->assertRedirect(route('login'));
        $this->get(route('organisations.show', compact('organisation')))->assertRedirect(route('login'));
        $this->get(route('organisations.edit', compact('organisation')))->assertRedirect(route('login'));
        $this->post(route('organisations.store'), $organisation->toArray())->assertRedirect(route('login'));
        $this->patch(route('organisations.update', compact('organisation')), $organisation->toArray())->assertRedirect(route('login'));
        $this->delete(route('organisations.destroy', compact('organisation')))->assertRedirect(route('login'));
    }

    /** @test */
    public function a_superadmin_can_list_all_organisations()
    {
        $user = factory('App\User')->create(['is_superadmin' => true]);
        $this->actingAs($user);

        /** @var Organisation $organisation */
        $organisation1 = factory(Organisation::class)->create();
        $organisation2 = factory(Organisation::class)->create();

        $this->get(route('organisations.index'))
            ->assertOk()
            ->assertSee($organisation1->name)
            ->assertSee($organisation2->name);
    }

    /** @test */
    public function an_admin_can_list_all_his_manageable_organisations()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);

        /** @var Organisation $organisation */
        $organisation1 = factory(Organisation::class)->create();
        $organisation1->users()->save($user, ['type' => UserType::Administrator]);

        $organisation2 = factory(Organisation::class)->create();

        $this->get(route('organisations.index'))
            ->assertOk()
            ->assertSee($organisation1->name)
            ->assertDontSee($organisation2->name);
    }
}
