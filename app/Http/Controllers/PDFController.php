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
        $department = 'กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก';
        $tel = '2703';
        $dateExport = '12 พฤศจิกายน 2566';
        $subject = 'ขออนุมัติในหลักการจัดซื้อ/จัดจ้าง';
        $data = [
            'title' => 'บันทึกข้อความ',
            'department' => $department,
            'tel' => $tel,
            'dateExport' => $dateExport,
            'subject' => $subject,
        ];
        // return view('pdf.procurementTemplate', $data);
        return $this->pdfService->generateFromView('pdf.procurementTemplate', $data);
    }
}
