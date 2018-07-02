@extends('layouts.admin')

@section('content')

    <h1>Replies</h1>

    @if(count($replies))

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{ $reply->id}}</td>
                    <td>{{ $reply->user->name ?? 'Unavailable' }}</td>
                    <td>{{ $reply->user->email ?? 'Unavailable' }}</td>
                    <td>{{ $reply->body }}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>
                    <td>

                        {!! Form::open(['method'=>'PUT', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                        @if($reply->is_active)
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

                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete', null, ['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}

                    </td>
            </tbody>
            @endforeach
        </table>

    @else

        <h1 class="text-center">No Replies</h1>

    @endif

@endsection
