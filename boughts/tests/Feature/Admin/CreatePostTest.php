<?php

namespace Tests\Feature\Admin;

use App\Category;
use App\Department;
use App\Post;
use App\Tag;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_unauthenticated_user_cant_create_post()
    {
        $response = $this->postJson(route('admin.posts.store'),$this->postData());
        $response->assertStatus(401);
    }
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_regular_user_cant_create_post()
    {
        $employee = $this->employeeUser();
        $this->actingAs($employee);
        $response = $this->postJson(route('admin.posts.store'),$this->postData());
        $response->assertStatus(401);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function an_admin_can_create_a_post()
    {
        $this->withoutExceptionHandling();
        $admin = $this->adminUser();

        $this->actingAs($admin)
            ->post(route('admin.posts.store'), $this->postData())
            ->assertRedirect(route('admin.posts.edit',1));

        $this->assertDatabaseHas('posts', [
            'title' => 'My First Post',
            'url' => 'my-first-post',
            'user_id' => $admin->id,
        ]);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function admin_can_complete_edit_required_fields_on_post()
    {
        $this->withoutExceptionHandling();

        $admin = $this->adminUser();

        $post = factory(Post::class)->create($this->postData([
            'user_id'=> $admin->id,
        ]));
        $category = factory(Category::class)->create();
        $tag1 = factory(Tag::class)->create();
        $tag2 = factory(Tag::class)->create();

        $data = [
            'title' => 'My Title',
            'excerpt'=> 'My Excerpt',
            'body' => 'My Body',
            'iframe'=> 'My Iframe',
            'published_at' => now()->subDays(1),
            'category_id' => $category->id,
            'tags' => [$tag1->id, $tag2->id],
        ];

        $this->actingAs($admin)
            ->put(route('admin.posts.update',$post), $data)
            ->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'My Title',
            'excerpt'=> 'My Excerpt',
            'body' => 'My Body',
            'iframe'=> 'My Iframe',
            'published_at' => now()->subDays(1),
            'category_id' => $category->id
        ]);

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id'=> $tag1->id,
        ]);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function admin_can_add_documents_to_post()
    {
        $this->withoutExceptionHandling();

        $admin = $this->adminUser();
        $category = factory(Category::class)->create();

        $post = factory(Post::class)->create($this->postData([
            'user_id'=> $admin->id,
            'category_id' => $category->id,
        ]));

        $data =[
            'document' => UploadedFile::fake()->create('doc1.pdf', 300)
        ];

        $this->actingAs($admin)
            ->post(route('admin.posts.document.update',$post), $data);

        $this->assertDatabaseHas('documents', [
            'title' => 'doc1.pdf',
            'post_id'=> $post->id,
        ]);

    }


    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function admin_can_add_departments_to_post()
    {
        $this->withoutExceptionHandling();

        $admin = $this->adminUser();

        $post = factory(Post::class)->create($this->postData([
            'user_id'=> $admin->id,
        ]));
        $category = factory(Category::class)->create();
        $tag1 = factory(Tag::class)->create();
        $tag2 = factory(Tag::class)->create();
        $department1 = factory(Department::class)->create();
        $department2 = factory(Department::class)->create();
        $date = now()->subDays(1);

        $data = [
            'title' => 'My Title',
            'excerpt'=> 'My Excerpt',
            'body' => 'My Body',
            'iframe'=> 'My Iframe',
            'published_at' => $date,
            'category_id' => $category->id,
            'tags' => [$tag1->id, $tag2->id],
            'departments' => [$department1->id, $department2->id],
        ];

        $this->actingAs($admin)
            ->put(route('admin.posts.update',$post), $data)
            ->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'My Title',
            'excerpt'=> 'My Excerpt',
            'body' => 'My Body',
            'iframe'=> 'My Iframe',
            'published_at' => $date,
            'category_id' => $category->id
        ]);

        $this->assertDatabaseHas('department_post', [
            'post_id' => $post->id,
            'department_id'=> $department1->id,
        ]);
    }

    protected function postData($overrides=[])
    {
        return array_merge([
            'title' => 'My First Post',
        ],$overrides);
    }

}
