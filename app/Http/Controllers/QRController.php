<?php

namespace App\Http\Controllers;

use App\ProofOfRole;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\Request;

class QRController extends Controller
{
    public function verify(Request $request, string $data)
    {
        $proof = null;
        try {
            $proof = ProofOfRole::getFromCryptedData($data);
        }
        catch(\Exception $e) {

        }

        return view('view_qr_scan', ['proof' => $proof]);
    }

    public function getQRCodeImage(Request $request, $data) {

        $proof = ProofOfRole::getFromCryptedData($data);

        $writer = new PngWriter();
        $qrcode = \Endroid\QrCode\QrCode::create($proof->getQRCodeURL());
        $result = $writer->write($qrcode);

        return response($result->getString())->header('Content-Type', $result->getMimeType());

    }
}
