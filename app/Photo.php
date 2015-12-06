<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    protected $fillable = ['path'];

    /**
     * Path to upload photos.
     *
     * @var string
     */
    protected $baseDir = 'flyers/photos';


    /**
     * A photo belongs to flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Get Photo instance, and move it to dir.
     *
     * @param UploadedFile $file
     * @return static
     */
    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;

        $name = time() . $file->getClientOriginalName();

        $photo->path = '/' . $photo->baseDir . '/' . $name;

        $file->move($photo->baseDir, $name);

        return $photo;
    }
}
