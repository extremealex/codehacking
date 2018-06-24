@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-sm-9">
            {!! Form::model($cat,['method'=>'PUT', 'action'=>['AdminCatController@update', $cat->id]]) !!}
            <div class="form-group @if($errors->has('name')) has-error @endif">
                {!! Form::label('name', 'Category Name') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                @if($errors->has('name')) <p class="text-danger">{{$errors->first('name')}}</p>@endif
            </div>

            <div class="form-group">
                {!! Form::submit('Update Category', null, ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
        <div class="col-sm-9">
            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCatController@destroy', $cat->id], 'class'=>'col-sm-6']) !!}
            <div class="form-group">
                {!! Form::submit('Delete Category', null, ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@endsection
