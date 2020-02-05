<?php

namespace Tests\Unit;

use App\Booking;
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
    public function it_can_have_attached_bookings()
    {
        /** @var Room $room */
        $room = factory(Room::class)->create();

        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();

        $room->bookings()->attach($booking->id);

        $this->assertNotNull($room->bookings);
        $this->assertInstanceOf(Collection::class, $room->bookings);

        $this->assertCount(1, $room->bookings);
        $this->assertSame($room->id, $room->bookings->find($booking->id)->id);
    }
}
