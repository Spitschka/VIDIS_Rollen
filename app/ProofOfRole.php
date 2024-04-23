<?php

namespace App;

use App\Print\PrintWithHeader;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProofOfRole
{
    private $first_name = "";

    private $last_name = "";

    private $role = 'student'; // or: teacher

    private $school = '';

    private $federal_sate = 'bayern';

    private \Carbon\Carbon $valid_until;

    public function __construct($first_name,$last_name,$role,$school,$federal_sate,$valid_until)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->role = $role;
        $this->school = $school;
        $this->federal_sate = $federal_sate;
        $this->valid_until = $valid_until;
    }

    /**
     * @return string
     */
    public function getFederalSate(): string
    {
        return $this->federal_sate;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getSchool(): string
    {
        return $this->school;
    }

    public function getValidUntil(): \Carbon\Carbon
    {
        return $this->valid_until;
    }

    public function isValid() {
        return $this->valid_until->isAfter(Carbon::now()) || $this->valid_until->isToday();
    }

    public function getJSON() {
        return json_encode($this->getDataArray());
    }

    public function getQRCodeURL() {
        $cryptedData = Crypt::encrypt($this->getDataArray());

        return route('qr.verify', ['data' => $cryptedData]);
    }

    public function getQRCodeImageURL() {
        $cryptedData = Crypt::encrypt($this->getDataArray());

        return route('qr.image', ['data' => $cryptedData]);
    }

    public function getDataArray() {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'role' => $this->role,
            'school' => $this->school,
            'federal_sate' => $this->federal_sate,
            'valid_until' => $this->valid_until->format('Y-m-d')
        ];
    }

    public function getXML() {
        $xml_data = new \SimpleXMLElement('<proof_of_role/>');
        $this->array_to_xml($this->getDataArray(),$xml_data);

        return $xml_data->asXML();
    }


    public function generatePDF() {
        $print = new PrintWithHeader('Rollennachweis');

        // $htmlPage = "<img src=\"" . $this->getQRCodeImageURL() . "\" width=\"30%\">";

        $html = view('print', ['proof' => $this])->toHtml();

        $print->newPage($html);

        $print->send();


    }


    public static function getFromCryptedData($data) : ProofOfRole|null
    {
        $data = Crypt::decrypt($data);
        return self::getFromData($data);
    }

    public static function getFromJson($json) {
        return self::getFromData(json_decode($json, true));
    }

    private static function getFromData($data) {
        $proof = new ProofOfRole(
            $data['first_name'],
            $data['last_name'],
            $data['role'],
            $data['school'],
            $data['federal_sate'],
            Carbon::make($data['valid_until'])
        );

        return $proof;
    }

    private function array_to_xml($data, &$xml_data) {
        foreach($data as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml_data->addChild("$key");
                    array_to_xml($value, $subnode);
                } else {
                    $subnode = $xml_data->addChild("item$key");
                    array_to_xml($value, $subnode);
                }
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }


    public function getValiDationInfo() {
        return "<data>" . $this->getJSON() . "</data><sig>" . Signing::sign($this->getJSON()) . "</sig>";
    }


}
