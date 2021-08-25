<?php

namespace App\Repositories ;

use App\Models\Post;

class PostRepo {

    function all()
    {
        return Post::all();
    }

    function find($id)
    {
        return Post::find($id);
    }

    function store($data)
    {
        return Post::create($data);
    }

    function update($id,$data)
    {
        Post::where('id',$id)
            ->update($data);
    }

    function delete ($id)
    {
        return Post::where('id',$id)->delete($id);
    }

}
