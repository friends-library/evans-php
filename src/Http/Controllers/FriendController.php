<?php

namespace Evans\Http\Controllers;

class FriendController
{
    /**
     * Respond to a GET /friend/{slug} request
     *
     * @param string $slug
     * @return void
     */
    public function slug(string $slug)
    {
        dump("the slug is: $slug");
    }
}
