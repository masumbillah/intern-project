<?php

namespace App\Repositories ;

use App\Models\User;

class UserRepo {

    function all()
    {
        return User::all();
    }

    function find($id)
    {
        return User::find($id);
    }

    function store($data)
    {
        return User::create($data);
    }

    function update($id,$data)
    {
        User::where('id',$id)
            ->update($data);
    }

    function delete ($id)
    {
        return User::where('id',$id)->delete($id);
    }

}
