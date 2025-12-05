<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    // Show Blade view
    public function index()
    {
        return view('articles.index');
    }

    // Return JSON for DataTables
    public function data(Request $request)
    {
        $query = Article::select('id','title','source','category','author','url','published_at');

        // Optional filtering (user selects category or source or author)
        if ($request->source) {
            $query->where('source', $request->source);
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }
        
        if ($request->author) {
            // $query->where('author', $request->author);
            $query->where('author', 'LIKE', '%' . $request->author . '%');
        }

        return DataTables::of($query)
        ->addColumn('link', function ($row) {
            return '<a class="btn btn-primary" href="'.$row->url.'" target="_blank">Read Article</a>';
        })
        ->rawColumns(['link'])
        ->make(true);
    }
}
