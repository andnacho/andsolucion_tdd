<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function manage()
    {

        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->get('/projects/create', $project->toArray())->assertRedirect('login');
        $this->get($project->path() . '/edit')->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');

    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function a_user_can_create_a_project()
    {

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $this->followingRedirects()->post('/projects', $attributes = factory(Project::class)->raw(['owner_id' => auth()->id()]))
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function task_can_be_included_as_part_a_new_project_creation()
    {
        $this->signIn();
        $attributes = factory(Project::class)->raw();

        $attributes['tasks'] = [
            ['body' => 'Task 1'],
            ['body' => 'Task 2']
        ];

        $this->post('projects', $attributes);

        $this->assertCount(2, Project::first()->tasks);

    }
    

    /** @test */
    public function a_user_can_update_a_project()
    {
        // $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = ['title' => 'Changes', 'description' => 'Changed', 'notes' => "Changed"])
            ->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = ['notes' => "Changed"]);

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function unauthorized_cannot_delete_a_project()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        $user = $this->signIn();

        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);

        $this->actingAs($user)->delete($project->path())->assertStatus(403);

//        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_delete_a_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        //given a user is signed in
        $user = $this->signIn();
        //when he is invited to a project that was no created by him
        $project = tap(ProjectFactory::create())->invite($user);


        //then he can see the project in the dashboard
        $this->get('/projects')
            ->assertSee($project->title);

    }


    /** @test */
    public function an_authenticated_user_cannot_view_others_projects()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_others_projects()
    {

        $this->signIn();

        $project = factory('App\Project')->create();

        $this->patch($project->path(), [])->assertStatus(403);
    }

    /** @test */
    public function a_project_require_a_title()
    {
        $this->signIn();

        $attributes = factory('App\Project')->create(['title' => '']);

        $this->post('/projects', $attributes->toArray())->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_require_a_description()
    {
        $this->signIn();

        $attributes = factory('App\Project')->raw(['description' => '', 'owner_id' => 1]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


}

