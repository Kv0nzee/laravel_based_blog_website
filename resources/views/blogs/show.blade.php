
<x-layout>
  <x-slot name="title">
      Blog
  </x-slot>
  
      <!-- singloe blog section -->
      <div class="container mt-5" style="padding:0">
        <div class="row">
            <div class="col-lg-6">
              <img src='{{asset("storage/$blog->image")}}' class="img-fluid" alt="{{$blog->title}}">
            </div>
            <div class="col-lg-6">
                <h1 class="product-title"> {{$blog->title }} </h1>
                <div class="d-flex justify-content-between">
                  <a href="/?categories={{$blog->category->slug}}" class="btn btn-primary  mb-3">Category: {{$blog->category->name}}</a>
                  <a href="/?authors={{$blog->author->username}}" class="btn btn-primary  mb-3">Author: {{$blog->author->name}}</a>
                </div>
                <div class="text-secondary"><span>{{$blog->created_at->diffForHumans()}}</span></div>  
                <p>{!!$blog->body!!}</p>
                <div class="d-flex align-items-center justify-content-between">
                  <form action="/blogs/{{$blog->slug}}/subscription" method="POST">
                    @csrf
                    @auth
                    @if (auth()->user()->isSubscribed($blog))
                      <button class="btn btn-danger">Unsubscribe</button>
                    @else
                      <button class="btn btn-warning">Subscribe</button>
                    @endif
                    @endauth
                  </form>
                </div>
            </div>
        </div>
      </div>
      <section class="container">
        <div class="col-md-8 mx-auto">
              @auth
                <x-comment-form :blog="$blog"/>
                @else
                <p class="text-center"> please <a href="/login">login</a> into participate in this discussion.</p>
              @endauth
        </div>
    </section>
    @if ($blog->comments->count())        
      {{-- comments section --}}
      <x-comments :comments="$blog->comments()->latest()->paginate(3)" />
    @endif
      <x-blogsYouMayLike :randomBlogs="$randomBlogs"/>
   
</x-layout>


