
<h1>Nachweis der Rolle</h1>

<table border="1" cellpadding="2" cellspacing="0" width="100%">
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
            {{ ($proof->getRole() == 'teacher' ? "Lehrkraft" : "Schüler/in") }} in {{ $proof->getFederalSate() }}
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

<hr>


<h3>Überprüfung (online)</h3>

Zur Überprüfung QR Code scannen und angezeigte Daten vergleichen.

<div style="text-align: center">
<img src="{{ $proof->getQRCodeImageURL() }}" width="200">
</div>


<hr>
<b>Bereich für automatische Überprüfung</b>
<font size="8">
<pre>{VALIDATIONINFO}<data>{{$proof->getValiDationInfo()}}</data>{/VALIDATIONINFO}
</pre>
</font>
