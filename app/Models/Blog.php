<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    // protected $fillable = ['title', 'category_id','intro', 'body', 'slug'];

    protected $with = ['category', 'author'];//amyl swl htote
    //Blog::without('text') m khw chin
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $filter){//Blog::lastes()->filter()
        $query->when($filter['search']??false, function($query,$search){
            $query->where(function($query) use($search){
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('body', 'LIKE', '%'.$search.'%');
            });
            // ->where('title', 'frontend'); AND logical grouping
        });
        $query->when($filter['category']??false, function($query,$slug){
            $query->whereHas('category', function($query) use ($slug) {
                $query->where('slug', $slug);
            });
        });
        $query->when($filter['author']??false, function($query,$author){
            $query->whereHas('author', function($query) use ($author) {
                $query->where(function($query) use($author){
                    $query->where('username', $author)
                        ->orWhere('name', $author);
                });
            });
        });
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function subscribers(){
        return $this->belongsToMany(User::class);
    }

    public function unSubscribe(){
        $this->subscribers()->detach(auth()->id());
    }

    public function subscribed(){
        $this->subscribers()->attach(auth()->id());
    }
}
// can create data in  php tinker
// Blog::create(['title'=>"backendblog", 'category_id'=>'2' ,'intro'=>'intro of backendblog', 'slug'=> 'backendblog' ,'body'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident, eum a illum natus consequuntur omnis '])