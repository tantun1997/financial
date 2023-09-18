<?php

namespace App\Http\Controllers;

use App\Services\PDFService;
use Illuminate\Http\Request;
// use thsplitlib\Segment;

class PDFController extends Controller
{
    protected $pdfService;

    public function __construct(PDFService $pdfService)
    {
        // $data = new Segment();
        // $data->get_segment_array('sss');

        $this->pdfService = $pdfService;
        $this->pdfService->setDefaultFont('garuda');
    }

    public function generateProcurement()
    {

        $department = 'กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก';
        $tel = '2703';
        $dateExport = '12 พฤศจิกายน 2566';
        $subject = 'ขออนุมัติในหลักการจัดซื้อ/จัดจ้าง';
        $planName = 'จัดซื้อวัสดุคอมพิวเตอร์ประจำปี 2564';
        $projectName = 'โครงการประจำปี 2564';
        $reason = 'เพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งานเพื่อใช้สำหรับสำรองการใช้งาน';

        // $reasons = $this->splitThaiWords($reason);
        // $reasons = wordwrap($reason, 75, "\n", TRUE);
        $data = [
            'title' => 'บันทึกข้อความ',
            'department' => $department,
            'tel' => $tel,
            'dateExport' => $dateExport,
            'subject' => $subject,
            'planName' => $planName,
            'projectName' => $projectName,
            'reason' => $reason,

        ];

        // return view('pdf.procurementTemplate', $data);
        return $this->pdfService->generateFromView('pdf.procurementTemplate', $data);
        // Pdf::setOption(['dpi' => 150, 'defaultFont' => 'TH SarabunIT๙']);
        // $pdf = Pdf::loadView('pdf.procurementTemplate', $data);
        // return $pdf->stream();
    }
}
