<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\postRepo;
use App\Traits\ImageStore;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    use ImageStore;

    protected $postRepo;

    function __construct(PostRepo $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        return view('post.index',[
            'posts' => $this->postRepo->all()
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(ArticaleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->imageSave('post',$request->image);
            $this->postRepo->store($data);
            return redirect()->back()->withSuccess('The post has been created successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }

    public function show($id)
    {
        return view('post.show',[
            'post' => $this->postRepo->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('post.edit',[
            'post' => $this->postRepo->find($id)
        ]);
    }

    public function update(PostRequest $request,$id)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->imageUpdate('post',$request->image);
            $this->postRepo->update($id,$data);
            return redirect()->back()->withSuccess('The post has been updated successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->back()->withSuccess('The post has been deleted successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }
}
