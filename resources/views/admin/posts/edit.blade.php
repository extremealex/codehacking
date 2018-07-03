@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-sm-3">
            <img src="{{$post->photo ? $post->photo->file : 'http://via.placeholder.com/400x510'}}" alt=""
                 class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            {!! Form::model($post, ['method'=>'PUT', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
            <div class="form-group @if($errors->has('title')) has-error @endif">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
                @if($errors->has('title'))<p class="text-danger">{{$errors->first('title')}}</p>@endif
            </div>

            <div class="form-group @if($errors->has('category_id')) has-error @endif">
                {!! Form::label('category_id', 'Category') !!}
                <select class="form-control" name="category_id">
                    @foreach($cats as $cat)
                        <option value="{{ $cat->id  }}"
                                @if($cat->id === $post->category_id) selected="selected" @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))<p class="text-danger">{{$errors->first('category_id')}}</p>@endif
            </div>

            <div class="form-group @if($errors->has('photo_id')) has-error @endif">
                {!!Form::label('photo_id', 'Photo')!!}
                {!!Form::file('photo_id', null, ['class'=>'form-control'])!!}
                @if($errors->has('photo_id'))<p class="text-danger">{{$errors->first('photo_id')}}</p>@endif
            </div>

            <div class="form-group @if($errors->has('body')) has-error @endif">
                {!!Form::label('body', 'Description:')!!}
                {!!Form::textarea('body', null, ['class'=>'form-control'])!!}
                @if($errors->has('body'))<p class="text-danger">{{$errors->first('body')}}</p>@endif
            </div>
            <div class="form-group">
                {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'class'=>'col-sm-6']) !!}
            <div class="form-group">
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-12']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>

@endsection
