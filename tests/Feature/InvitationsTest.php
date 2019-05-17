<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();
        
        $userToInvite = factory(User::class)->create();

        $this->actingAs($project->owner)->post($project->path() . '/invitations', [
            'email' => $userToInvite->email
        ]);
        
        $this->assertTrue($project->members->contains($userToInvite));
        
    }
    
    /** @test */
    public function the_invited_email_address_must_be_a_valid_birdboard_account()
    {
        
    }
    
    /** @test */
    public function invited_user_may_update_project_details ()
    {


        //Given I Have a project
        $project = ProjectFactory::create();

        //When the owner of the project invites another user
        $project->invite($newUser = factory(User::class)->create());


        //Then, that new user will have permission to add tasks.
        $this->signIn($newUser);

        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
