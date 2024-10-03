@extends('dashboard.master')

@section('content')
    <a href="{{route('post.index')}}">Back</a>
    <form action="{{route('post.store')}}" method="POST">
        @include('dashboard.fragment.errors')
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title">

        <label for="slug">Slug</label>
        <input type="text" name="slug">

        <label for="description">Description</label>
        <input type="text" name="description">

        <label for="content">Content</label>
        <textarea type="text" name="content"></textarea>

        <label for="category">Category</label>
        <select name="category_id" id="">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <label for="posted">Posted</label>
        <select name="posted" id="">
            <option value="yes">yes</option>
            <option value="not">not</option>
        </select>

        <button type="submit">send</button>
    </form>
@endsection