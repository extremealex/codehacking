@extends('layouts.admin')



@section('content')

    <h1>Create User</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
    <div class="form-group @if($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        @if($errors->has('name')) <p class="text-danger">{{$errors->first('name')}}</p>@endif
    </div>

    <div class="form-group @if($errors->has('email')) has-error @endif">
        {!!Form::label('email', 'Email:')!!}
        {!!Form::email('email', null, ['class'=>'form-control'])!!}
        @if($errors->has('email')) <p class="text-danger">{{$errors->first('email')}}</p>@endif
    </div>

    <div class="form-group  @if($errors->has('password')) has-error @endif">
        {!!Form::label('password', 'Password:')!!}
        {!!Form::password('password', ['class'=>'form-control'])!!}
        @if($errors->has('password')) <p class="text-danger">{{$errors->first('password')}}</p>@endif
    </div>

    <div class="form-group  @if($errors->has('role_id')) has-error @endif">
        {!!Form::label('role_id', 'Role:')!!}
        {{--        {!!Form::select('role_id',$roles, null, ['class'=>'form-control'])!!}--}}
        <select class="form-control" name="role_id">
            <option value="" disabled="disabled" selected="selected">Choose value</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        @if($errors->has('role_id')) <p class="text-danger">{{$errors->first('role_id')}}</p>@endif
    </div>

    <div class="form-group">
        {!!Form::label('is_active', 'Status:')!!}
        {!!Form::select('is_active', array(1=>'Active', 0=>'Inactive'), 0, ['class'=>'form-control'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('photo_id', 'Photo:')!!}
        {!!Form::file('photo_id', null, ['class'=>'form-control'])!!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create User',  ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    @include('includes.form_error')

@endsection