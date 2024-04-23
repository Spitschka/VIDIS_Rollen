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
            <h3 class="card-title"><i class="fa fa-pencil-alt"></i> Ausstellen</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('issue.create') }}" method="post">
                @csrf

                <div class="form-group">
                    Rolle*
                    <select name="role" class="form-control">
                        <option value="teacher">Lehrkraft</option>
                        <option value="student">Schüler</option>
                    </select>
                </div>

                <div class="form-group">
                    Nachname*
                    <input type="text" class="form-control" name="name" required value="Spitschka">
                </div>

                <div class="form-group">
                    Vorname*
                    <input type="text" class="form-control" name="first_name" required value="Christian">
                </div>

                <div class="form-group">
                    Bundesland*
                    <select name="federal_state" class="form-control">
                        <option value="BW">Baden-Württemberg</option>
                        <option value="BY" selected>Bayern</option>
                        <option value="BE">Berlin</option>
                        <option value="BB">Brandenburg</option>
                        <option value="HB">Bremen</option>
                        <option value="HH">Hamburg</option>
                        <option value="HE">Hessen</option>
                        <option value="MV">Mecklenburg-Vorpommern</option>
                        <option value="NI">Niedersachsen</option>
                        <option value="NW">Nordrhein-Westfalen</option>
                        <option value="RP">Rheinland-Pfalz</option>
                        <option value="SL">Saarland</option>
                        <option value="SN">Sachsen</option>
                        <option value="ST">Sachsen-Anhalt</option>
                        <option value="SH">Schleswig-Holstein</option>
                        <option value="TH">Thüringen</option>
                    </select>
                </div>

                <div class="form-group">
                    Schule*
                    <input type="text" class="form-control" name="school" value="Realschule Unterpfaffenhofen" required>
                </div>

                <div class="form-group">
                    Gültigkeit*
                    <input type="date" class="form-control" name="valid_until" value="{{ \Illuminate\Support\Carbon::now()->addDays(60)->format("Y-m-d") }}">
                </div>


                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-pencil-alt"></i> Ausstellen</button>

            </form>
        </div>
    </div>

@stop
