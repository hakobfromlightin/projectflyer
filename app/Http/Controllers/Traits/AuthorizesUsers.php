<?php

namespace App\Http\Controllers\Traits;

use App\Flyer;
use Illuminate\Http\Request;

trait AuthorizesUsers
{

    /**
     * Make sure user created the flyer.
     *
     * @param Request $request
     * @return mixed
     */
    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => $this->user->id
        ])->exists();
    }

    /**
     * Unauthorized response or redirect.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    protected function unauthorized(Request $request)
    {
        if($request->ajax()){
            return response(['message' => 'No way.'], 403);
        }

        flash('No way.');

        return redirect('/');
    }

}