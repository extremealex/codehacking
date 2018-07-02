@extends('layouts.admin')

@section('content')

    <h1>Comments</h1>

    @if(count($comments))

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post</th>
                <th>Replies Count</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->user->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>
                    <td>{{ $comment->replies->count() }}</td>
                    <td>

                        {!! Form::open(['method'=>'PUT', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                        @if($comment->is_active)
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Unapprove', null, ['class'=>'btn btn-success']) !!}
                            </div>
                        @else
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', null, ['class'=>'btn btn-info']) !!}
                            </div>
                        @endif

                        {!! Form::close() !!}
                    </td>
                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete', null, ['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}

                    </td>
            </tbody>
            @endforeach
        </table>

    @else

        <h1 class="text-center">No Comments</h1>

    @endif

@endsection
