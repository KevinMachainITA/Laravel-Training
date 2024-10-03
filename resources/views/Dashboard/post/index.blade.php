@extends('dashboard.master')

@section('content')

<a href="{{route('post.create')}}">Create a new post</a>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Content</th>
            <th>Images</th>
            <th>Posted</th>
            <th>Category</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->description }}</td>
            <td>{{ $post->content }}</td>
            <td>
                @if($post->image)
                    <img src="/uploads/posts/{{$post->image}}" style="width:250px" alt="">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $post->posted }}</td>
            <td>{{ $post->category->title ?? 'No Category' }}</td>
            <td>
                <a href="{{route('post.edit',$post)}}">Edit</a>
                <form action="{{route('post.destroy',$post)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection