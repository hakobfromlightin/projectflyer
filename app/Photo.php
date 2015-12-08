<?php

namespace App;

use Image;
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
     * The UploadedFile instance.
     *
     * @var array
     */
    protected $file;


    /**
     * When a photo is created, prepare a thumbnail, too.
     *
     * @return void
     */
    protected static function boot()
    {
        static::creating(function($photo){
            return $photo->upload();
        });
    }

    /**
     * Make a new photo instance from an uploaded file.
     *
     * @param UploadedFile $file
     * @return self
     */
    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);
    }

    /**
     * Move the photo to the proper folder.
     *
     * @return self
     */
    public function upload()
    {
        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnails();

        return $this;
    }

    /**
     * Make a thumbnail for the photo.
     *
     * @return void
     */
    private function makeThumbnails()
    {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }

    /**
     * Get the file name for the photo.
     *
     * @return string
     */
    public function fileName()
    {
        $name = sha1( time() . $this->file->getClientOriginalName());

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    /**
     * Get the path to the photo.
     *
     * @return string
     */
    public function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }


    /**
     * Get the path to the photo's thumbnail.
     *
     * @return string
     */
    public function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
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

}
