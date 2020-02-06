<?php

namespace Tests\Feature\Web;

use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageRoomsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_room()
    {
        $this->withoutExceptionHandling();

        $this->get(route('rooms.create'))->assertStatus(200);

        $attributes = factory(Room::class)->raw();

        $this->post(route('rooms.store'), $attributes)->assertRedirect(route('rooms.index'));

        $this->assertDatabaseHas('rooms', $attributes);

        $this->get(route('rooms.index'))->assertSee($attributes['name']);
    }

    /** @test */
    public function a_user_can_view_a_room()
    {
        $this->withoutExceptionHandling();

        /** @var Room $room */
        $room = factory(Room::class)->create();

        $this->get(route('rooms.show', compact('room')))
            ->assertSee($room->name)
            ->assertSee($room->capacity);
    }


    /** @test */
    public function a_room_requires_a_name()
    {
        $attributes = factory(Room::class)->raw(['name' => '']);

        $this->post(route('rooms.store'), $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_room_requires_a_capacity()
    {
        $attributes = factory(Room::class)->raw(['capacity' => '']);

        $this->post(route('rooms.store'), $attributes)->assertSessionHasErrors('capacity');
    }


    /** @test */
    public function a_rooms_capacity_should_be_integer()
    {
        $attributes = factory(Room::class)->raw(['capacity' => $this->faker->word]);

        $this->post(route('rooms.store'), $attributes)->assertSessionHasErrors('capacity');
    }

    /** @test */
    public function a_room_requires_needs_a_relation_to_an_organisation()
    {
        $attributes = factory(Room::class)->raw(['organisation_id' => '']);

        $this->post(route('rooms.store'), $attributes)->assertSessionHasErrors('organisation_id');
    }

    /** @test */
    function a_user_can_update_a_room()
    {
        $this->withoutExceptionHandling();

        /** @var Room $room */
        $room = factory(Room::class)->create(['name' => 'Initial', 'capacity' => '1']);

        $this->get(route('rooms.edit', compact('room')))->assertStatus(200);

        $this->patch(route('rooms.update', compact('room')), $attributes = ['name' => 'Changed', 'capacity' => '2'])
            ->assertRedirect(route('rooms.show', compact('room')));

        $this->assertDatabaseHas('rooms', $attributes);
    }


    /** @test */
    function a_user_can_delete_a_room()
    {
        $this->withoutExceptionHandling();

        /** @var Room $room */
        $room = factory(Room::class)->create();

        $this->delete(route('rooms.destroy', compact('room')))
            ->assertRedirect(route('rooms.index'));

        $this->assertDatabaseMissing('rooms', $room->only('id'));
    }
}
