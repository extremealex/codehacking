@extends('layouts.admin')

@section('content')

    @if($photos)
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td>@if($photo->file)<img height="50" src="{{$photo->file}}">@else No Photo @endif</td>
                    {{--                <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>--}}
                    <td>{{$photo->created_at->diffForHumans() ?? 'no date'}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete Media', null, ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
