<?php

namespace App\Http\Controllers;

use App\ProofOfRole;
use App\Signing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Exception;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

class UploadController extends Controller
{
    public function index(Request $request) {
        return view("upload-index");
    }

    public function upload(Request $request) {
        $file = $request->file('file');


        $parser = new Parser();

        $pdf = $parser->parseFile($file->path());

        $text = Str::between(str_replace("\n","",str_replace("\r","", $pdf->getText())),
            "{VALIDATIONINFO}",
            "{/VALIDATIONINFO}");

        $data = Str::between($text, "<data>","</data>");
        $signature = Str::between($text, "<sig>","</sig>");

        $proof = null;

        try {
            if (Signing::checkSignature($data, $signature, $request->post('public_key'))) {
                $proof = ProofOfRole::getFromJson($data);
            }
        }
        catch (\Exception $e) {}

        if($proof == null) {
            return back()->with('error', "Datei ungültig!");
        }

        return view("upload-success", compact("proof"));
    }

}
