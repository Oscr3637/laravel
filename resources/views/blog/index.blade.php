@extends('blog.layout')
@section('content')
    <x-blog.post.index :posts="$posts"> 
        Articulos:
        @slot('footer')
            Footer
        @endslot
        @slot('extra')
            Extra
        @endslot
 
    </x-blog.post.index>     
@endsection
