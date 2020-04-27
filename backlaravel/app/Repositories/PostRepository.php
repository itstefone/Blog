<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use App\Contracts\PostContract;
use App\Post;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends BaseRepository implements PostContract {

  use UploadTrait;


  public function __construct(Post $model)
  {
    parent::__construct($model);
  }

  public function createPost(array $attributes) {

    $collection = collect($attributes);

    $imagePath = $this->uploadOne($collection->get('image'),'blogpost_tmp');
    
    $collection->put('image', $imagePath);

    $this->create($collection->toArray());
    return response()->json([
          'status' => 'success',
    ],201);

  }



  public function listPosts(array $columns = ['*'], $orderBy ='id', $sortBy = 'asc') {

    $posts =  $this->all($columns, $orderBy, $sortBy);

    return response()->json([
          'posts' => $posts->load('user')
    ],200);
  }

}