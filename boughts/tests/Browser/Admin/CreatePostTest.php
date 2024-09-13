<?php

namespace Tests\Browser\Admin;

use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     * @throws \Throwable
     * @test
     */
    public function admin_creates_a_new_post()
    {
        $admin = $this->adminUser();

        $this->browse(function (Browser $browser)use($admin){
            $browser->loginAs($admin)
                ->visitRoute('admin.posts.index')
                ->press('@create-btn')
                ->waitFor('@my-modal', 5)
                ->whenAvailable('@my-modal', function ($modal) {
                    $modal->type('title', 'Mi Primer Post')
                        ->press('@store-btn')
                        ->pause(1000);
                })
                ->assertRouteIs('admin.posts.edit','mi-primer-post');
        });

        $this->assertDatabaseHas('posts',[
            'title'=> 'Mi Primer Post',
            'url' => 'mi-primer-post',
            'user_id' => $admin->id,
        ]);
    }


 /**
 * @return void
 * @throws \Throwable
 * @test
 */
    public function post_title_is_required()
    {
        $admin = $this->adminUser();

        $this->browse(function (Browser $browser) use($admin){
            $browser->loginAs($admin)
                ->visitRoute('admin.posts.index')
                ->press('@create-btn')
                ->waitFor('@my-modal', 5)
                ->whenAvailable('@my-modal', function ($modal) {
                    $modal->press('@store-btn')
                        ->pause(1000);
                })
                ->assertSee('The title field is required.');
        });
    }

    /**
     * @return void
     * @throws \Throwable
     * @test
     */
    public function post_title_must_be_at_least_3_characters()
    {
        $admin = $this->adminUser();

        $this->browse(function (Browser $browser)use($admin){
            $browser->loginAs($admin)
                ->visitRoute('admin.posts.index')
                ->press('@create-btn')
                ->waitFor('@my-modal', 5)
                ->whenAvailable('@my-modal', function ($modal) {
                    $modal->type('title', 'Mi')
                        ->press('@store-btn')
                        ->pause(1000);
                })
                ->assertSee('The title must be at least 3 characters.');
        });
    }


    /**
     * @return void
     * @throws \Throwable
     * @test
     */
    public function edit_fields_required()
    {
        $admin = $this->adminUser();

        $post = factory(Post::class)->create($this->postData([
            'user_id'=> $admin->id,
        ]));

        $this->browse(function (Browser $browser) use($admin,$post){
            $browser->loginAs($admin)
                ->visitRoute('admin.posts.edit',$post)
                ->type('title','')
                ->type('body','')
                ->type('category_id','')
                ->type('tags','')
                ->press('@edit-btn')
                ->assertSee('The title field is required.')
                ->assertSee('The body field is required.')
                ->assertSee('The category id field is required.')
                ->assertSee('The tags field is required.');
        });
    }

    /**
     * @return void
     * @throws \Throwable
     * @test
     */
    public function edit_post_iframe_must_be_at_least_3_characters()
    {
        $admin = $this->adminUser();

        $post = factory(Post::class)->create($this->postData([
            'user_id'=> $admin->id,
        ]));

        $this->browse(function (Browser $browser) use($admin,$post){
            $browser->loginAs($admin)
                ->visitRoute('admin.posts.edit',$post)
                ->type('title','My Title')
                ->type('body','My body')
                ->type('iframe','ti')
                ->press('@edit-btn')
                ->assertSee('The iframe must be at least 3 characters.');
        });
    }


    protected function postData($overrides=[])
    {
        return array_merge([
            'title' => 'My First Post',
        ],$overrides);
    }
}
