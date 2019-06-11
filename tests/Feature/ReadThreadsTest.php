<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
/** @test  */
    public function a_user_can_browse_threads()
    {
       

        $response = $this->get('/threads')
                ->assertSee($thread->title);

        
    }
/** @test */
    public function a_user_can_browse_thread()
    {
    

    $response = $this->get('/threads'. $thread->id)
            ->assertSee($thread->title);
    }

}

/** @test */

function a_user_can_read_replies_that_are_associated_with_a_thread()
{
    // Given we have a thread

    // And that thread includes replies

    $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

    // When we visit a thread page

        $this->get('/threads'. $thread->id)
                ->assertSee($reply->body);
    // Then we should see the replies.





}
