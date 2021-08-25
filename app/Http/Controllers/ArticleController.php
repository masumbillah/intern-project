<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticaleRequest;
use App\Models\Article;
use App\Repositories\ArticleRepo;
use App\Traits\ImageStore;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    use ImageStore;

    protected $articleRepo;

    function __construct(ArticleRepo $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function index()
    {
        return view('article.index',[
            'articles' => $this->articleRepo->all()
        ]);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(ArticaleRequest $request)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->imageSave('articles',$request->image);
            $this->articleRepo->store($data);
            return redirect()->back()->withSuccess('The article has been created successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }

    public function show($id)
    {
        return view('article.show',[
            'article' => $this->articleRepo->find($id)
        ]);
    }

    public function edit($id)
    {
        return view('article.edit',[
            'article' => $this->articleRepo->find($id)
        ]);
    }

    public function update(ArticaleRequest $request,$id)
    {
        try {
            $data = $request->validated();
            $data['image'] = $this->imageUpdate('articles',$request->image);
            $this->articleRepo->update($id,$data);
            return redirect()->back()->withSuccess('The article has been updated successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
        // $article->update($request->validated());
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return redirect()->back()->withSuccess('The article has been deleted successfully !');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->withError('Something went wrong !');
        }
    }
}
