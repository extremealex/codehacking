@extends('layouts.admin')

@section('content')

    <div class="row">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
        <div class="form-group @if($errors->has('title')) has-error @endif">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
            @if($errors->has('title'))<p class="text-danger">{{$errors->first('title')}}</p>@endif
        </div>

        <div class="form-group @if($errors->has('category_id')) has-error @endif">
            {!! Form::label('category_id', 'Category') !!}
            <select class="form-control" name="category_id">
                <option value="" disabled="disabled" selected="selected">Select Category</option>
                @foreach($cats as $cat)
                    <option value="{{ $cat->id  }}">{{ $cat->name }}</option>
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
            {!! Form::submit('Post', null, ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>

@endsection
