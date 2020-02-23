<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Organisation
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Room[] $rooms
 * @property-read int|null $rooms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation manageableBy(\App\User $user)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organisation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Organisation extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'slug'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function subdomain()
    {
        $parts = parse_url(config('app.url'));
        return $parts['scheme'] . '://' . $this->slug . '.' . $parts['host'];
    }
}
