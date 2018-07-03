@extends('layouts.admin')

@section('content')


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Post</th>
            <th>Comments</th>
            <th>Comments Count</th>
            <th>Crated</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>

        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>@if ($post->photo)<img height="50" src="{{ $post->photo->file ?? '' }}"> @else No Photo @endif
                    </td>
                    <td>{{ $post->user->name ?? '' }}</td>
                    <td>{{ $post->category->name ?? '' }}</td>
                    <td><a href="{{route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                    <td>{!! $post->body !!}</td>
                    <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
                    <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                    <td>{{ number_format($post->comments()->count()) }}</td>
                    <td>{{ $post->created_at->diffForHumans() ?? '' }}</td>
                    <td>{{ $post->updated_at->diffForHumans() ?? '' }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->render() }}
        </div>
    </div>


@endsection
