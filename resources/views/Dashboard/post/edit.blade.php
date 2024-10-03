@extends('dashboard.master')

@section('content')
    <form action="{{route('post.update',$post)}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('dashboard.fragment.errors')
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" value="{{old('title',$post->title)}}">

        <label for="slug">Slug</label>
        <input type="text" name="slug" value="{{old('slug',$post->slug)}}">

        <label for="description">Description</label>
        <input type="text" name="description" value="{{old('description',$post->description)}}">

        <label for="content">Content</label>
        <textarea type="text" name="content">{{old('content',$post->content)}}</textarea>

        <label for="image">Image</label>
        <input type="file" name="image">

        <label for="category">Category</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option {{old('category_id',$post->category_id) == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <label for="posted">posted</label>
        <select name="posted" id="">
            <option value="yes" {{old('posted',$post->posted) == 'yes' ? 'selected' : ''}}>yes</option>
            <option value="not" {{old('posted',$post->posted) == 'not' ? 'selected' : ''}}>not</option>
        </select>

        <button type="submit">send</button>
    </form>
@endsection