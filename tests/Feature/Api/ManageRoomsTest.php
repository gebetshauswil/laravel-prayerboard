<?php

namespace Tests\Feature\Api;

use App\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageRoomsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function the_api_can_list_the_rooms()
    {
        $this->withoutExceptionHandling();

        factory(Room::class, 5)->create();

        $this->get(route('api.rooms.index'))
            ->assertJsonCount(5, 'data')
            ->assertOk();
    }

    /** @test */
    public function the_api_can_view_a_room()
    {
        $this->withoutExceptionHandling();

        /** @var Room $room */
        $room = factory(Room::class)->create();

        $this->get(route('api.rooms.show', compact('room')))
            ->assertSee($room->name)
            ->assertSee($room->capacity)
            ->assertOk();
    }

    /** @test */
    public function the_api_can_create_a_room()
    {
        $this->withoutExceptionHandling();

        $attributes = factory(Room::class)->raw();

        $this->post(route('api.rooms.store'), $attributes)->assertCreated();

        $this->assertDatabaseHas('rooms', $attributes);

        $this->get(route('api.rooms.index'))->assertSee($attributes['name']);
    }

    /** @test */
    public function the_api_can_not_create_a_room_without_a_name()
    {
        $attributes = factory(Room::class)->raw(['name' => '']);

        $this->post(route('api.rooms.store'), $attributes)
            ->assertSee('The name field is required.')
            ->assertStatus(422);

        $this->assertDatabaseMissing('rooms', $attributes);
    }

    /** @test */
    public function the_api_can_not_create_a_room_without_a_capacity()
    {
        $attributes = factory(Room::class)->raw(['capacity' => '']);

        $this->post(route('api.rooms.store'), $attributes)
            ->assertSee('The capacity field is required.')
            ->assertStatus(422);

        $this->assertDatabaseMissing('rooms', $attributes);

        $attributes = factory(Room::class)->raw(['capacity' => $this->faker->word]);

        $this->post(route('api.rooms.store'), $attributes)
            ->assertSee('The capacity must be an integer.')
            ->assertStatus(422);

        $this->assertDatabaseMissing('rooms', $attributes);
    }

    /** @test */
    function the_api_can_update_all_properties_of_a_room()
    {
        $this->withoutExceptionHandling();

        $initial_attributes = ['name' => 'Initial', 'capacity' => '1'];

        /** @var Room $room */
        $room = factory(Room::class)->create($initial_attributes);

        $this->patch(route('api.rooms.update', compact('room')), $attributes = ['name' => 'Changed', 'capacity' => '2'])
            ->assertSee($attributes['name'])
            ->assertSee($attributes['capacity']);

        $this->assertDatabaseHas('rooms', $attributes);
    }

    /** @test */
    function the_api_can_update_the_name_of_a_room()
    {
        $this->withoutExceptionHandling();

        $initial_attributes = ['name' => 'Initial', 'capacity' => '1'];

        /** @var Room $room */
        $room = factory(Room::class)->create($initial_attributes);

        $this->patch(route('api.rooms.update', compact('room')), $attributes = ['name' => ''])
            ->assertSee('The name field is required.')
            ->assertStatus(422);

        $this->assertDatabaseHas('rooms', $initial_attributes);

        $this->patch(route('api.rooms.update', compact('room')), $attributes = ['name' => 'Changed'])
            ->assertSee($attributes['name'])
            ->assertSee($initial_attributes['capacity'])
            ->assertOk();

        $this->assertDatabaseHas('rooms', array_merge($initial_attributes, $attributes));
    }

    /** @test */
    function the_api_can_update_the_capacity_of_a_room()
    {
        $this->withoutExceptionHandling();

        $initial_attributes = ['name' => 'Initial', 'capacity' => '1'];

        /** @var Room $room */
        $room = factory(Room::class)->create($initial_attributes);

        $this->patch(route('api.rooms.update', compact('room')), $attributes = ['capacity' => ''])
            ->assertSee('The capacity field is required.')
            ->assertStatus(422);

        $this->assertDatabaseHas('rooms', $initial_attributes);

        $this->patch(route('api.rooms.update', compact('room')), $attributes = ['capacity' => $this->faker->word])
            ->assertSee('The capacity must be an integer.')
            ->assertStatus(422);

        $this->assertDatabaseHas('rooms', $initial_attributes);

        $this->patch(route('api.rooms.update', compact('room')), $attributes = ['capacity' => '2'])
            ->assertSee($attributes['capacity'])
            ->assertSee($initial_attributes['name'])
            ->assertOk();

        $this->assertDatabaseHas('rooms', array_merge($initial_attributes, $attributes));
    }

    /** @test */
    public function the_api_can_delete_a_room()
    {
        $this->withoutExceptionHandling();

        /** @var Room $room */
        $room = factory(Room::class)->create();

        $this->delete(route('api.rooms.destroy', compact('room')))
            ->assertStatus(204);

        $this->assertDatabaseMissing('rooms', $room->only('id'));
    }
}
