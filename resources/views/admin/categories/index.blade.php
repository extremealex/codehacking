@extends('layouts.admin')

@section('content')


    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>

        @if($cats)
            @foreach($cats as $cat)
                <tr>
                    <td>{{$cat->id}}</td>
                    <td><a href="{{route('admin.categories.edit', $cat->id)}}">{{$cat->name}}</a></td>
                    <td>{{$cat->created_at->diffForHumans()}}</td>
                    <td>{{$cat->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>



@endsection
