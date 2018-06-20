@extends('layouts.admin')

@section('content')

    <h1>Admin\Users\Index</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
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
                <td>{{$user->name}}</td>
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