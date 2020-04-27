<?php
namespace App\Contracts;



  interface PostContract  {

    public function createPost(array $attributes);
    public function listPosts(array $columns, $orderBy, $sortBy);
}