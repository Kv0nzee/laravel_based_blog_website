<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index', [
            'blogs'=>Blog::latest()
                    ->filter(request(['search', 'category', 'author']))
                    ->paginate(6)
                    ->withQueryString()
            // 'categories'=>Category::all(),
            // 'currentCategory'=>request('category');
        ]);
    }
    
    public function show(Blog $blog)
    {
        return view('blogs.show', [
            'blog'=>$blog, 
            'randomBlogs'=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    public function subscriptionHandler(Blog $blog){
        if(User::find(auth()->id())->isSubscribed($blog)){
            $blog->unSubscribe();
        }else{
            $blog->subscribed();
        }
        return back();
    }

    // protected function getBlogs()
    // {
        // $query=Blog::latest();
        // if (request('search')) {
        //     $blogs=$blogs->where('title', 'LIKE', '%'.request('search').'%')
        //                 ->orWhere('body', 'LIKE', '%'.request('search').'%');
        // }
        // $query->when(request('search'), function($query,$search){
        //     $query->where('title', 'LIKE', '%'.$search.'%')
        //             ->orWhere('body', 'LIKE', '%'.$search.'%');
        // });

        // return $query->get();
    // }
}