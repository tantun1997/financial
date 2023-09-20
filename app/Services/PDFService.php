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
            'orientation' => 'P',
            'debug' => true,
        ]);
        // $this->mpdf->text_input_as_HTML = true;
        // $this->mpdf->allow_charset_conversion = true;
        // $this->mpdf->charset_in = 'utf-8';
        $this->mpdf->useDictionaryLBR = true;
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
