<?php

namespace App\Services;

use Mpdf\Mpdf;

class PDFService
{
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 11,
            'margin_left' => 22,
            'margin_right' => 16,
            'margin-bottom' => 5,
            // 'tabSpaces' => 4
        ]);
    }
    public function setDefaultFont($font)
    {
        $this->mpdf->SetDefaultFont($font);
    }
    public function generateFromView($view, $data = [])
    {
        $html = view($view, $data)->render();
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();
    }
}
