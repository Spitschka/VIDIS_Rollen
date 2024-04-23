<?php

namespace App\Http\Controllers;

use App\Signing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index(Request $request) {
        $privateKey = Signing::getPrivateKey();
        $publicKey = Signing::getPublicKey();




        die();


// Überprüfe die Signatur mit dem öffentlichen Schlüssel

        if ($r == 1) {
            echo "Die Verifikation war erfolgreich.\n";
        } elseif ($r == 0) {
            echo "Die Verifikation ist fehlgeschlagen.\n";
        } else {
            echo "Fehler bei der Überprüfung der Signatur.\n";
        }

    }
}
