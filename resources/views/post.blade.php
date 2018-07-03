@extends('layouts.blog-post')

@section('content')


    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo->file ?? '' }}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{!! $post->body !!}</p>
    <hr>
    @if(Session::has('comment_message'))
        {{session('comment_message')}}
    @endif

    @if(Session::has('reply_message'))
        {{ session('reply_message') }}
    @endif

    <!-- Blog Comments -->
    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
            <div class="form-group">

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                {!! Form::label('body', 'Body') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit comments', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    @endif
    <hr>

    <!-- Posted Comments -->
    @if(count($comments))

        @foreach($comments as $comment)


            <!-- Comment -->
            <div id="comments-block" class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object"
                         src="{{$comment->user->photo->file ?? 'http://placehold.it/64x64'}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name ?? 'Unavailable'}}
                        <small>{{$comment->created_at->diffForHumans() ?? 'No date'}}</small>
                        <p>{{$comment->body}}</p>
                    </h4>
                    <div class="replies-block">
                        <!-- Replies -->
                        @if(count($comment->replies))

                            @foreach ($comment->replies as $reply)
                                @if($reply->is_active)
                                    <div id="nested_comment" class="media">
                                        <a class="pull-left" href="#">
                                            <img height="64" class="media-object"
                                                 src="{{ $reply->user->photo->file ?? 'http://placehold.it/64x64' }}"
                                                 alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ $reply->user->name ?? 'Unavailable' }}
                                                <small>{{ $reply->created_at->diffForHumans() ?? 'No Date' }}</small>
                                            </h4>
                                            <p>{{ $reply->body }}</p>
                                        </div>

                                    </div>
                                @endif
                            @endforeach
                            @if(!count($comment->replies))

                                <div class="comment-replies-container">
                                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                    <div id="reply-box" class="comment-reply col-sm-9">
                                        {!! Form::open(['method'=>'POST', 'action'=>['CommentRepliesController@createReply', $comment->id]]) !!}
                                        <div class="form-group">
                                            {!! Form::label('body', 'Body') !!}
                                            {!! Form::textarea('body', null, ['class'=>'form-control col-sm-6', 'rows'=>1]) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::submit('Submit Reply', ['class'=>'btn btn-primary']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                        @endif
                    @endif
                    <!-- End Reply -->

                    </div>
                </div>
            </div>

            <div class="comment-replies-container">
                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                <div id="reply-box" class="comment-reply col-sm-9">
                    {!! Form::open(['method'=>'POST', 'action'=>['CommentRepliesController@createReply', $comment->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('body', 'Body') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control col-sm-6', 'rows'=>1]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit Reply', ['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

        @endforeach
    @endif


@endsection

@section('scripts')

    <script>

        $('.toggle-reply').click(function () {
            $(this).next().slideToggle('slow');
        });

    </script>


@endsection
