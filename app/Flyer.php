<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{

    /**
     * Fillable fields for the flyer model.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
    ];


    /**
     * Find the flyer at the given address.
     *
     * @param string $zip
     * @param string $street
     * @return mixed
     */
    public static function locatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        return static::where(compact('zip', 'street'))->firstOrFail();
    }

    /**
     * Get Price accessor.
     *
     * @param $price
     * @return string
     */
    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }

    /**
     * Add photos to the Flyer.
     *
     * @param Photo $photo
     * @return Model
     */
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * A flyer is composed of many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    /**
     * A flyer is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determin if the given user created the flyer.
     *
     * @param User $user
     * @return bool
     */
    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }
}
