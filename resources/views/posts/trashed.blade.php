@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Title
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Restore
                </th>
                <th>
                    Destroy
                </th>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr>

                        <td><img src="{{ $post->feature }}" alt="{{ $post->content }}" width="50px" height="50px"></td>
                        <td>{{ $post->title }}</td>
                        <td>Edit</td>
                        <td>
                            <a href="{{ route('post.restore', ['id'=>$post->id]) }}" class="btn btn-xs btn-success">Restore</a>
                        </td>
                        <td>
                            <a href="{{ route('post.kill', ['id'=>$post->id]) }}" class="btn btn-xs btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop











