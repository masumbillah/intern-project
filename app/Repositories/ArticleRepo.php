<?php

namespace App\Repositories ;

use App\Models\Article;

class ArticleRepo {

    function all()
    {
        return Article::all();
    }

    function find($id)
    {
        return Article::find($id);
    }

    function store($data)
    {
        return Article::create($data);
    }

    function update($id,$data)
    {
        Article::where('id',$id)
            ->update($data);
    }

    function delete ($id)
    {
        return Article::where('id',$id)->delete($id);
    }

}
