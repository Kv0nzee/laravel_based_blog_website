<!-- navbar -->
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark px-5">
    <div class="container">
      <a class="navbar-brand" href="/">Creative Coder</a>
      <div class="d-flex align-items-center">
        <a href="/#blogs" class="nav-link link">Blogs</a>
        @auth
        @can('admin')
        <a href="/admin/blogs" class="nav-link link">Dashboard</a>
        @endcan
        <img src="{{auth()->user()->avatar}}" class="rounded-circle" width="50" alt="">
          <a href="/" class="nav-link link">{{auth()->user()->name}}</a>
          <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-button " type="submite">Logout</button>
          </form>
        @else  
          <a href="/register" class="nav-link link">Register</a>
          <a href="/login" class="nav-link link">Login</a>
        @endauth
      </div>
    </div>
  </nav>