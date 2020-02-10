<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Booking
 *
 * @property int $id
 * @property string $starting_at
 * @property int $minutes
 * @property int $private
 * @property int $room_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Room $room
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking wherePrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereStartingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Booking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Booking extends Model
{
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
