@extends('layouts.admin')

@section('content')
    <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCatController@store']) !!}
        <div class="form-group @if($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Category Name') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            @if($errors->has('name')) <p class="text-danger">{{$errors->first('name')}}</p>@endif
        </div>

        <div class="form-group">
            {!! Form::submit('Create Category', null, ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>
@endsection
