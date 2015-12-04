<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * Table name of the model.
     *
     * @var string
     */
    protected $table = "flyer_photos";

    /**
     * Fillable fields for the Photo model.
     *
     * @var array
     */
    protected $fillable = ['photo'];


    /**
     * A photo belongs to flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }
}
