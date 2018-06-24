@extends('layouts.admin')

@section('content')

    @if(Session::has('created_user'))
        <p class="bg-danger">{{Session::get('created_user')}}</p>
    @endif

    @if(Session::has('updated_user'))
        <p class="bg-danger">{{Session::get('updated_user')}}</p>
    @endif

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{Session::get('deleted_user')}}</p>
    @endif

    <h1>Admin\Users\Index</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <td>Created</td>
            <td>Updated</td>
        </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                {{--<td>{!! $user->photo ? "<img src=\"/images/" . htmlentities($user->photo->file) . "\">" : '<p>No Photo</p>' !!}</td>--}}
                <td>@if ($user->photo) <img height="50" src="{{ $user->photo->file }}"> @else No Photo @endif</td>
                <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name ?? 'N/A'}}</td>
                <td>{{$user->is_active ?'Active' : 'Inactive'}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
            </tr>
        @empty
            <tr class="text-center text-danger">
                <td colspan="100">Nothing here</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection