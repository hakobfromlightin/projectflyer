<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    /**
     * The associated table.
     *
     * @var string
     */
    protected $table = "flyer_photos";

    /**
     * Fillable fields for a photo.
     *
     * @var array
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];

    /**
     * Set name mutator.
     *
     * @param $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir(). '/' . $name;
        $this->thumbnail_path = $this->baseDir(). '/tn-' . $name;
    }

    /**
     * Get the base directory for photo uploads.
     *
     * @return string
     */
    public function baseDir()
    {
        return $baseDir = 'images/photos';
    }

    /**
     * A photo belongs to a flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    /**
     * Delete picture and call parent delete.
     *
     * @throws \Exception
     */
    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

}
