@extends('adminlte::page')

@section('title', 'Rollennachweis mit VIDIS')

@section('content_header')
    <h1>Rollennachweis mit VIDIS (POC)</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <i class="fa fa-exclamation-triangle"></i> {{ $error }}<br>
            @endforeach
        </div>
    @endif


    @if (\Illuminate\Support\Facades\Session::get('error') != null)
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> {{ \Illuminate\Support\Facades\Session::get('error') }}<br>
        </div>
    @endif


    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-pencil-alt"></i> Automatische Überprüfung</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('upload.upload') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    Datei*
                    <input type="file" accept="application/pdf" name="file">
                </div>

                <div class="form-group">
                    Öffentlicher Schlüssel*
                    <textarea name="public_key" rows="10" class="form-control">{{ \App\Signing::getPublicKey() }}</textarea>
                </div>

                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-pencil-alt"></i> Überprüfen</button>

            </form>
        </div>
    </div>

@stop
