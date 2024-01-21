<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    function index(){
        return view('admin.blogs.index', [
            'blogs'=> Blog::latest()->paginate(6)
        ]);
    }

    public function create(){

        return view('admin.blogs.create', [
            'categories'=> Category::all()
        ]);
    }

    public function store()
    {
        $formData = request()->validate([
            "title" => ["required"],
            "slug" =>  ["required", Rule::unique('blogs', 'slug')],
            "intro" =>  ["required"],
            "body" =>  ["required"],
            "category_id" =>  ["required", Rule::exists('categories', 'id')]
        ]);
        $formData['user_id'] = auth()->id();
        $formData['image'] = request()->file('image')->store('images');
        
        Blog::create($formData);

        return redirect('/admin/blogs/');
    }

    public function destory(Blog $blog){
        $blog->delete();

        return back();
    }

    public function edit(Blog $blog){

        return view('admin.blogs.edit', [
            'categories'=> Category::all(),
            'blog' => $blog
        ]);
    }

    public function update(Blog $blog){

        $formData = request()->validate([
            "title" => ["required"],
            "slug" =>  ["required"],
            "intro" =>  ["required"],
            "body" =>  ["required"],
            "category_id" =>  ["required", Rule::exists('categories', 'id')]
        ]);
        $formData['image'] = request()->file('image') ?  request()->file('image')->store('images') : $blog->image;

        $blog->update($formData);

        return redirect('/admin/blogs/');
    }
}
