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
            Edit tag: {{$tag->tag}}
        </div>
        <div class="card-body">
            <form action="{{ route('tag.update', ['id'=>$tag->id])  }}" method="post" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Tag</label>
                    <input type="text" name="tag" class="form-control" value="{{$tag->tag}}">
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