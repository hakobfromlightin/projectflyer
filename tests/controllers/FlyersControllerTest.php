<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FlyersControllerTest extends TestCase
{
    /** @teste */
    public function it_shows_the_form_to_create_a_new_flyer()
    {
        $this->visit('flyers/create');
    }
}
