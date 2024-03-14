<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Interface\PostInterface;
use Session;

class PostController extends Controller
{   
    public function __construct(PostInterface $postInterface) {
        $this->postInterface = $postInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->postInterface->index();
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(PostRequest $request)
    {
        //
        $this->postInterface->storeOrUpdate($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        //
        $this->postInterface->storeOrUpdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return $this->postInterface->deletePost($id);
    }
}
