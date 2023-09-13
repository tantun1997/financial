<?php

namespace App\Services;

use Mpdf\Mpdf;

class PDFService
{
    public function generatePdf($view, $data = [])
    {
        $mpdf = new Mpdf();
        $html = view($view, $data)->render();
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();
    }
}
