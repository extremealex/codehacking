@extends('layouts.admin')

@section('content')

    <h1>Edit User</h1>
    <div class="row">
        <div class="col-sm-3">
            <img src="{{$user->photo ? $user->photo->file : 'http://via.placeholder.com/400x510'}}" alt=""
                 class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            {!! Form::model($user, ['method'=>'PUT', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
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
                        <option value="{{ $role->id }}"
                                @if($role->id === $user->role_id) selected="selected" @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('role_id')) <p class="text-danger">{{$errors->first('role_id')}}</p>@endif
            </div>

            <div class="form-group">
                {!!Form::label('is_active', 'Status:')!!}
                {!!Form::select('is_active', array(1=>'Active', 0=>'Inactive'), null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!!Form::label('photo_id', 'Photo:')!!}
                {!!Form::file('photo_id', null, ['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'class'=>'col-sm-6']) !!}
            <div class="form-group">
                {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-12']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @include('includes.form_error')
    </div>

@endsection