<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\PostRepository;
use App\Models\Post;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_new_post()
    {
        $repository = new PostRepository(new Post);

        $data = [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
        ];

        $response = $repository->storeOrUpdate($data);

        $this->assertEquals(201, $response->status());
        $this->assertDatabaseHas('posts', $data);
    }

    /** @test */
    public function it_can_update_an_existing_post()
    {
        $post = factory(Post::class)->create();

        $repository = new PostRepository(new Post);

        $data = [
            'title' => 'Updated Post Title',
            'body' => 'Updated post body.',
        ];

        $response = $repository->storeOrUpdate($data, $post->id);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('posts', $data);
    }
}
