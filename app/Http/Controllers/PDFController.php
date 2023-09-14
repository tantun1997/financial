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
        $data = [
            'title' => 'บันทึกข้อความ',
            // Add any other data you want to pass to the view
        ];
        // return view('pdf.procurementTemplate', $data);
        return $this->pdfService->generateFromView('pdf.procurementTemplate', $data);
    }
}
