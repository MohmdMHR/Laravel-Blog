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
            Edit Settings
        </div>
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="post" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Site Name</label>
                    <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" name="address" value="{{ $settings->address}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Contact</label>
                    <input type="number" name="contact_number" value="{{ $settings->contact_number}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" name="contact_email" value="{{ $settings->contact_email}}" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success">
                            Update Settings
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop