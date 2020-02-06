<?php

namespace Tests\Unit;

use App\Booking;
use App\Organisation;
use App\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_an_id()
    {
        /** @var Room $room */
        $room = factory(Room::class)->create();
        $this->assertNotNull($room->id);
    }

    /** @test */
    public function it_has_a_name()
    {
        /** @var Room $room */
        $room = factory(Room::class)->create();
        $this->assertNotNull($room->name);
    }

    /** @test */
    public function it_has_a_capacity()
    {
        /** @var Room $room */
        $room = factory(Room::class)->create();
        $this->assertNotNull($room->capacity);
    }

    /** @test */
    public function it_has_timestamps()
    {
        /** @var Room $room */
        $room = factory(Room::class)->create();
        $this->assertNotNull($room->created_at);
        $this->assertNotNull($room->updated_at);
    }

    /** @test */
    public function it_belongs_to_an_organisation()
    {
        /** @var Room $room */
        $room = factory(Room::class)->create();

        $this->assertInstanceOf(Organisation::class, $room->organisation);
    }
}
