<?php

namespace App\Http\Controllers;

use App\ProofOfRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
{
    public function index(Request $request) {
        return view("issue");
    }

    public function issue(Request $request) {

        $validator = Validator::make($request->all(), [
            'role' => 'required|in:student,teacher',
            'name' => 'required|string|min:3',
            'first_name' => 'required|string|min:3',
            'federal_state' => 'required|in:BW,BY,BE,BB,HB,HH,HE,MV,NI,NW,RP,SL,SN,ST,SH,TH',
            'school' => 'required|string|min:3',
            'valid_until' => 'required|date|after_or_equal:today',
        ], [
            'valid_until.after_or_equal' => 'Das Datum muss in der Zukunft oder heute liegen.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        // $first_name,$last_name,$role,$school,$federal_sate,$valid_until
        $proofOfRole = new ProofOfRole(
            $request->post('first_name'),
            $request->post('name'),
            $request->post('role'),
            $request->post('school'),
            $request->post('federal_state'),
            Carbon::make($request->post('valid_until'))
        );


        $proofOfRole->generatePDF();
        // QrCode Image URL: $proofOfRole->getQRCodeImageURL();

       //  return response($proofOfRole->getXML());
    }
}
