<?php

namespace Tests\Unit;

use App\Booking;
use App\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpseclib\Math\BigInteger;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_an_id()
    {
        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();
        $this->assertNotNull($booking->id);
    }

    /** @test */
    public function it_has_a_starting_point()
    {
        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();
        $this->assertNotNull($booking->starting_at);
    }

    /** @test */
    public function it_has_a_duration()
    {
        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();
        $this->assertNotNull($booking->minutes);
    }

    /** @test */
    public function it_has_a_privacy()
    {
        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();
        $this->assertNotNull($booking->private);
    }

    /** @test */
    public function it_has_timestamps()
    {
        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();
        $this->assertNotNull($booking->created_at);
        $this->assertNotNull($booking->updated_at);
    }

    /** @test */
    public function it_belongs_to_a_room()
    {
        /** @var Booking $booking */
        $booking = factory(Booking::class)->create();

        $this->assertInstanceOf(Room::class, $booking->room);
    }
}
