<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Blog{
    public $title;
    public $fileName;
    public $intro;
    public $body;
    public $date;


    public function __construct($title, $fileName, $intro, $body, $date){
        $this->title = $title;
        $this->fileName = $fileName;
        $this->intro = $intro;
        $this->body = $body;
        $this->date = $date;
    }

    public static function all(){
        return collect(File::files(resource_path("blogs")))
        ->map(function($file){
            $obj = YamlFrontMatter::parseFile($file);
            return new Blog($obj->title, $obj->fileName, $obj->intro, $obj->body(), $obj->date);
        })
        ->sortBy('date');
    }
    
    public static function find($fileName){
    
        $blogs = static::all();
        return $blogs->firstWhere("fileName", $fileName);
    }

    public static function findOrFail($fileName){

        $blog =static::find($fileName);
        if(!$blog){
            throw new ModelNotFoundException();
        }
        
        return $blog;
    }












    // public static function all(){
        // return array_map(function($file){
        //     $obj = YamlFrontMatter::parseFile($file);
        //     return new Blog($obj->title, $obj->fileName, $obj->intro, $obj->body());
        // }, File::files(resource_path("blogs")));
        //for simple html tag
        // return array_map(function($file){
        //     return $file->getContents();
        // }, File::files(resource_path("blogs")));
    // }
        
    // public static function find($fileName){
    
    //     //using collection
    //     $blogs = static::all();
    //     dd($blogs->fir)

    //     //simple method
    //     // // $filePath = __DIR__."/../resources/blogs/$fileName.html";
    //     // $filePath = resource_path("blogs/$fileName.html");
    //     // if(!file_exists($filePath)){
    //     //     return redirect('/');
    //     // //    abort(404);
    //     // }
        
    //     // return cache()->remember("posts.$fileName", 1, function() use ($filePath) {
    //     //     $obj = YamlFrontMatter::parseFile($filePath);
    //     //     return new Blog($obj->title, $obj->fileName, $obj->intro, $obj->body());
    //     // });
    // }
}