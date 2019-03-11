@extends('layouts.app')

@section('content')


    @include('includes.errors')
    <div class="card">
        <div class="card-header">
            Update Category: {{ $category->name }}
        </div>
        <div class="card-body">
            <form action="{{ route('category.update', ['id'=>$category->id]) }}" method="post" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success">
                            Update
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop