@props(['blogs'])

<section class="container text-center py-5" id="blogs">
    <x-category-dropdown/>
    <form action=""  class="my-3">
      <div class="input-group mb-3">
        @if(request('author'))
        <input
          name="author"
          value="{{request('author')}}"
          type="hidden"
        />
        @endif
        @if(request('category'))
        <input
          name="category"
          value="{{request('category')}}"
          type="hidden"
        />
        @endif
        <input
          name="search"
          value="{{request('search')}}"
          type="text"
          autocomplete="false"
          class="form-control"
          placeholder="Search Blogs..."
        />
        <button
          class="btn"
          id="basic-addon2"
          type="submit"
        >
          Search
        </button>
      </div>
    </form>
    <div class="row">
        @forelse($blogs as $blog)
          <x-blogCard :blog="$blog"/>
        @empty
            <p class="textcenter">No blogs found.</p>
        @endforelse 
        {{$blogs->links()}}
    </div>
  </section>