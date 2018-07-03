@extends('layouts.admin')

@section('content')

    @if($photos)

        <form action="delete/media" method="post" class="form-inline">

            {{ csrf_field() }}
            {{ method_field('delete') }}

            <dive class="form-group">
                <select name="checkBoxArray" class="form-control" id="">
                    <option value="">Delete</option>
                </select>
            </dive>

            <dive class="form-group">
                <input type="submit" class="btn-primary" name="delete_all"/>
            </dive>

            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" id="options"></th>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
                        </td>
                        <td>{{$photo->id}}</td>
                        <td>@if($photo->file)<img height="50" src="{{$photo->file}}">@else No Photo @endif</td>
                        {{--                <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>--}}
                        <td>{{$photo->created_at->diffForHumans() ?? 'no date'}}</td>
                        <td>

                            <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                            <div class="form-group">
                                <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    @endif

@endsection

@section('scripts')

    <script>

        $(document).ready(function () {
            $('#options').click(function () {
                if (this.checked) {
                    $('.checkBoxes').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkBoxes').each(function () {
                        this.checked = false;
                    });
                }
            });
        });

    </script>

@endsection