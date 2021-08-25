<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepo;
use App\Traits\ImageStore;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use ImageStore;

    protected $userRepo;

    function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('user.index',[
            'users' => $this->userRepo->all()
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(ArticaleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->imageSave('users',$request->image);
            $this->userRepo->store($data);
            return redirect()->back()->withSuccess('The user has been created successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }

    public function show($id)
    {
        return view('user.show',[
            'user' => $this->userRepo->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('user.edit',[
            'user' => $this->userRepo->find($id)
        ]);
    }

    public function update(UserRequest $request,$id)
    {
        try {
            $data = $request->validated();
            $this->userRepo->update($id,$data);
            return redirect()->back()->withSuccess('The user has been updated successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->withSuccess('The user has been deleted successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }
}
