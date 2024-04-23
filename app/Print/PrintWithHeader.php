<?php

namespace App\Print;

use Illuminate\Support\Facades\URL;

class PrintWithHeader extends \TCPDF
{
    private $name = '';

    public function __construct($name)
    {
        parent::__construct('P', 'mm', 'A4', true, 'UTF-8', false, true);

        // set document information
        $this->SetCreator('VIDIS');
        $this->SetAuthor('VIDIS');
        $this->SetTitle($name);

        $this->name = $name;

        $this->SetMargins(20, 45, 23, false);
    }

    //Page header
    public function Header()
    {
        // Logo

        $image_file = URL::to('images/siegel.png');

        $this->Image($image_file, 20, 10, '', '27', 'PNG', '', 'M', false, 300, '', false, false, 0, false, false, false);
    }
    public function newPage($html, $fontSize=11)
    {

        // $html = nl2br($html);

        $this->AddPage();

        $this->SetXY(20, 40);
        $this->SetFont('courier', '', $fontSize);

        $this->writeHTML("<div style=\"text-align: justify\">$html</div>", true, false, true, false, '');
    }

    public function send($noOutput = false)
    {
        if (config('app.env') == 'local') {
            $this->Output($this->name.'.pdf', 'I');
        }

        if (! $noOutput) {
            $this->Output($this->name.'.pdf', 'D');
        }
    }
}
