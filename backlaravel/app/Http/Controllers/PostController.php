<?php

namespace App\Http\Controllers;

use App\Contracts\PostContract;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $postRepository;
    public function __construct(PostContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    

    public function index() {
        return    $this->postRepository->listPosts();
    }

    public function store(Request $request) {
        return $this->postRepository->createPost($request->all());
    }
}
