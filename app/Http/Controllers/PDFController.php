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
    }

    public function generateProcurement()
    {

        $data = [
            'title' => 'Sample PDF',
            // Add any other data you want to pass to the view
        ];

        return $this->pdfService->generatePdf('pdf.procurementTemplate', $data);
    }
}
