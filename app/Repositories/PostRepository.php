<?php

namespace App\Repositories;

use App\Interface\PostInterface;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseAPI;
use Exception;
use Session;

class PostRepository implements PostInterface
{
    use ResponseAPI;
    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index()
    {
        $data = Post::all();
        return inertia('Post', [
            'data' => $data, 
            'flash' => [
                'message' => Session::get('message'),
            ]
        ]);
    }

    public function storeOrUpdate(PostRequest $request, $id = null)
    {
        // return $request->all();
        DB::beginTransaction();
        try {
            $post = $id ? $this->post->find($id) : new $this->post;
            // Check the post 
            if($id && !$post) return $this->error("No post with ID $id", 404);
            
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            DB::commit();
            Session::flash('message', $id ? "Post successfully updated." : "Successfully created post.");
            return $this->success( $id ? "Post updated" : "Post created", $post, $id ? 200 : 201);
        } catch(Exception $error) {
            DB::rollBack();
            return $this->error($error->getMessage(), $error->getCode());
        }
    }

    public function deletePost($id)
    {
        try {
            DB::beginTransaction();
            //find post
            $post = $this->post->find($id);

            if (!$post) return $this->error("No post with ID $id", 404);
            
            //else 
            $post->delete();
            DB::commit();
            Session::flash('message', 'Successfully deleted post');
            // Redirect back to the page that displays the list of items
            return redirect()->route('posts.index');
        } catch (Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }
    }
}