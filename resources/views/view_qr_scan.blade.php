@extends('adminlte::page')

@section('title', 'Rollennachweis mit VIDIS')

@section('content_header')
    <h1>Prüfung mit QR Code</h1>
@stop

@section('content')

    @if($proof == null)
        <div class="callout callout-danger">
            Der QR Code ist ungültig!
        </div>
    @elseif(!$proof->isValid())
        <div class="callout callout-danger">
            Der QR Code ist nicht mehr gültig!
        </div>

    @else

    <div class="callout callout-success">
        Der QR Code ist gültig!
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-pencil-alt"></i> Verifizierte Daten</h3><br>
            Abgleich mit Ausweis nötig!
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td width="20%">
                        <b>Vorname</b>
                    </td>
                    <td width="80%">
                        {{ $proof->getFirstName() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Nachname</b>
                    </td>
                    <td>
                        {{ $proof->getLastName() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Rolle</b>
                    </td>
                    <td>
                        {{ ($proof->getRole() == 'teacher' ? "Lehkraft" : "Schüler/in") }} in {{ $proof->getFederalSate() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Schule</b>
                    </td>
                    <td>
                        {{ $proof->getSchool() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Gültig bis</b>
                    </td>
                    <td>
                        {{ $proof->getValidUntil()->format("d.m.Y") }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @endif

@stop
