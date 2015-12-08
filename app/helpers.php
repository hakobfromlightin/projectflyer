<?php

/**
 * Create a Flash object and call info method on it.
 *
 * @param null $title
 * @param null $message
 * @return \Illuminate\Foundation\Application|mixed
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

/**
 * The path to a given flyer.
 *
 * @param App\Flyer $flyer
 * @return string
 * @internal param Flyer $path
 */
function flyer_path(App\Flyer $flyer)
{
    return $flyer->zip . '/' . str_replace(' ', '-', $flyer->street);
}