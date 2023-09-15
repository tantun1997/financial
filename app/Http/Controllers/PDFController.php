<?php

namespace App\Http\Controllers;
use App\Services\PDFService;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    protected $pdfService;

    public function __construct(PDFService $pdfService)
    {
        $this->pdfService = $pdfService;
        $this->pdfService->setDefaultFont('garuda');
    }

    public function generateProcurement()
    {
        $str = '          ด้วยกลุ่มงาน/ฝ่าย/งาน กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี 2567 โดยมีรายละเอียดดังนี้';
        $text = wordwrap($str,50,"\n");
        $data = [
            'title' => 'บันทึกข้อความ',
            'text' => $text,
        ];
        // return view('pdf.procurementTemplate', $data);
        return $this->pdfService->generateFromView('pdf.procurementTemplate', $data);
    }
}
