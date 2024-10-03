@extends('dashboard.master')

@section('content')
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
                    <p>{{$post->image}}</p>
                @else
                    No Image
                @endif
            </td>
            <td>{{ $post->posted }}</td>
            <td>{{ $post->category->title ?? 'No Category' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection