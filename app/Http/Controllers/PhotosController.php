<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\AddPhotoToFlyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPhotoRequest;
use App\Photo;

class PhotosController extends Controller
{
    /**
     * Apply a photo the referenced flyer.
     *
     * @param $zip
     * @param $street
     * @param AddPhotoRequest $request
     * @internal param $AddPhotoRequest
     */
    public function store($zip, $street, AddPhotoRequest $request)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();

    }

    /**
     * Delete photo.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Photo::findOrFail($id)->delete();

        return back();
    }
}
