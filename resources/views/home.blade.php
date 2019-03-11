@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            {!! $chart->html() !!}
        </div>
    </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
@endsection