<?php

namespace App\Services;

use Mpdf\Mpdf;

class PDFService
{
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf([
            // 'autoPageBreak' => true,
            // 'autoScriptToLang' => true,
            // 'autoLangToFont' => true,
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 9,
            'margin_left' => 20,
            'margin_right' => 14,
            'margin-bottom' => 3,

            // 'tabSpaces' => 4
        ]);
        $this->mpdf->useSubstitutions = true;
        $this->mpdf->SetDisplayMode('fullpage', 'single');
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
