@extends('adminlte::page')

@section('title', 'Rollennachweis mit VIDIS')

@section('content_header')
    <h1>Rollennachweis mit VIDIS (POC)</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">
@markdom(str_replace("{APPURL}",config("app.url"),file_get_contents(base_path('README.md'))))

        </div>
    </div>
@stop
