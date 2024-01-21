<x-layout>
    <x-slot name="title">
        Admin
    </x-slot>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-2 mt-5">
            <ul class="list-group">
                <li class="list-group-item"><a class=" text-muted" href="/admin/blogs/">Dashboard</a></li>
                <li class="list-group-item"><a  class=" text-muted"href="/admin/blogs/create">Create Blog</a></li>
              </ul>
        </div>
        <div class="col-md-10">
            {{$slot}}
        </div>
    </div>
</div>
</x-layout>