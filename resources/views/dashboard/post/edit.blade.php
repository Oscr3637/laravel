@extends('dashboard.layout')
@section('content')
@include('dashboard.fragment._errors-form')
<form action="{{ route('post.update', $post->id) }}" method="post">
    @method('PATCH')
    @csrf
    <label for="">Title</label>
    <input type="text" name="title" value="{{ $post->title }}">
    <br>
    <label for="">Slug</label>
    <input type="text" name="slug" value="{{ $post->slug }}">
    <br>
    <label for="">Content</label>
    <textarea name="content">{{ $post->content }}</textarea>
    <br>
    <label for="">Category</label>
    <select name="category_id">
        @foreach ($categories as $title => $id)
        <option {{ $post->category->id == $id ? 'selected' : ''}} value="{{ $id }}">{{ $title }}</
                option>
            @endforeach
    </select>
    <br>
    <label for="">Description</label>
    <textarea name="description">{{ $post->description }}</textarea>
<br>
    <label for="">Posted</label>
    <select name="posted">
        <option {{ $post->posted == 'not' ? 'selected' : ''}} value="not">Not</option>
        <option {{ $post->posted == 'yes' ? 'selected' : ''}} value="yes">Yes</option>
    </select>
    <br>
    <button type="submit">Send</button>
</form>
@endsection