<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Organisation
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Organisation extends Model
{
    protected $fillable = ['name'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
