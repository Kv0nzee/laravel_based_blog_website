<x-layout>
    <x-slot name="title">
        Home
    </x-slot>
    @if (session('success'))
        <div class="alert alert-success text-center"> {{session('success')}}</div>
    @endif
    <!-- blogs section -->
    <x-blogsSection 
        :blogs="$blogs" 
    />

</x-layout>