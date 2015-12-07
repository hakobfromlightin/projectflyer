<?php

namespace App;

use Image;
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
    protected $fillable = ['path', 'name', 'thumbnail_path'];

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
        return $this->belongsTo(Flyer::class);
    }

    /**
     * Get Photo instance, and move it to dir.
     *
     * @param $name
     * @return static
     * @internal param UploadedFile $file
     */
    public static function named($name)
    {
        $photo = new static;

        return $photo->saveAs($name);
    }

    /**
     * Setting image properties.
     *
     * @param $name
     * @return $this
     */
    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }

    /**
     * Move existing image to the path.
     *
     * @param UploadedFile $file
     * @return $this
     */
    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnails();


        return $this;
    }

    /**
     * Create thumbnail for image.
     */
    private function makeThumbnails()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }
}
