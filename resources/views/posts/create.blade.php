@extends('layouts.app')

@section('content')

    @if(count($errors)>0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="group-item text-danger">
                    {{ $error }}
                </li>
            @endforeach

        </ul>
    @endif
    <div class="card">
        <div class="card-header">
            Create a post
        </div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="featured">Featured Image</label>
                    <input type="file" name="featured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                   @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{$tag->id}}">{{ $tag->tag }}</label>
                        </div>
                   @endforeach
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="summernote" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop


@section('styles')

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">

@stop

@section('scripts')

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

    <script>

            $('#summernote').summernote({

                placeholder:'',
                tabsize:2,
                height:99

                });

    </script>
@stop