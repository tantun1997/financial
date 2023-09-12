<?php

namespace App\Services;

use Mpdf\Mpdf;

class PDFService
{
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf();
    }

    public function generateFromView($view, $data = [])
    {
        $html = view($view, $data)->render();
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();
    }
}
