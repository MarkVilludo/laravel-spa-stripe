<?php

namespace App\Interface;

use App\Http\Requests\PostRequest;

interface PostInterface
{

    public function index();

    /**
     * Create | Update post
     * 
     * @param   \App\Http\Requests\PostRequest    $request
     * @param   integer                           $id
     * 
     * @method  POST    api/posts       For Create
     * @method  PUT     api/posts/{id}  For Update     
     * @access  public
    */
    public function storeOrUpdate(PostRequest $request);

    /**
     * 
     *  Delete Post
     *
     * @param $id
     * @method post/{id}
     * @method delete
     * @access public
    */

    public function deletePost($id);
}