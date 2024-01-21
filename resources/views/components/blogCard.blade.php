@props(['blog'])

<div class="col-md-4 mb-4 d-flex">
    <div class="col my-3 bg-secondary">
        <div class="card h-100 shadow-sm" style="backgroud:inherit">
            <a href="/blogs/{{$blog->slug}}" class="btn" style="height:200px; padding:0;">
                <img src='{{asset("storage/$blog->image")}}' style="border-radius:30px; padding:0;" class="card-img-top w-full h-full" alt="Blog Image">
            </a>
            <div class="card-body">
                <div class="clearfix mb-3">
                    <span class="float-start badge rounded-pill">
                        <a class="btn btn-primary" href="/?author={{$blog->author->username}}{{request('search')?'&search='.request('search') : ''}}{{request('category')?'&category='.request('category'):''}}">
                           Author - {{$blog->author->name}}
                        </a>
                    </span>
                    <span class="float-end">{{$blog->created_at->diffForHumans()}}</span>
                </div>
                <div class="d-flex clearfix">
                    <a href="/?category={{$blog->category->slug}}{{request('search')?'&search='.request('search') : ''}}{{request('author')?'&author='.request('author'):''}}">
                        <span class="badge link  ">Category : {{$blog->category->name}}</span>
                      </a>
                </div>
                <h5 class="card-title mt-3">{{$blog->title}}</h5>
                <div class="text-center my-4">
                    <a href="/blogs/{{$blog->slug}}" class="btn btn-primary">Read more</a>
                </div>
            </div>
        </div>
    </div>
</div>
