<?php

namespace App\Http\Controllers;

use App\Services\PDFService;
use Illuminate\Http\Request;
// use thsplitlib\Segment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

Carbon::setLocale('th');

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

    public function MaintenancePDF($id)
    {
        $Plan = DB::table('PDFแผนบำรุงรักษา')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการครุภัณฑ์แผนบำรุงรักษา')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $timeExport = Carbon::now()->format('H:i:s');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.maintenanceTemplatePage1', $data);
        $this->pdfService->addNewPage('L', '', '1', '', '', '10', '10', '20', '20', '5', '5', '', '', '', '', '', '', '', '', '', 'A4');
        $this->pdfService->setHeader('โรงพยาบาลสมเด็จพระพุทธเลิศหล้า||หน้า {PAGENO}/{nbpg}');
        $this->pdfService->setFooter('||วันที่พิมพ์ : ' . $dateExport . ' ' . $timeExport);
        $this->pdfService->addContent('pdf.maintenanceTemplatePage2', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }

    public function RepairPDF($id)
    {
        $Plan = DB::table('PDFแผนซ่อม')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการครุภัณฑ์แผนซ่อม')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $timeExport = Carbon::now()->format('H:i:s');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.repairTemplatePage1', $data);
        $this->pdfService->addNewPage('L', '', '1', '', '', '10', '10', '20', '20', '5', '5', '', '', '', '', '', '', '', '', '', 'A4');
        $this->pdfService->setHeader('โรงพยาบาลสมเด็จพระพุทธเลิศหล้า||หน้า {PAGENO}/{nbpg}');
        $this->pdfService->setFooter('||วันที่พิมพ์ : ' . $dateExport . ' ' . $timeExport);
        $this->pdfService->addContent('pdf.repairTemplatePage2', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }
    public function ReplacementPDF($id)
    {
        $Plan = DB::table('PDFแผนทดแทน')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการครุภัณฑ์แผนทดแทน')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $timeExport = Carbon::now()->format('H:i:s');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.replacementTemplatePage1', $data);
        $this->pdfService->addNewPage('L', '', '1', '', '', '10', '10', '20', '20', '5', '5', '', '', '', '', '', '', '', '', '', 'A4');
        $this->pdfService->setHeader('โรงพยาบาลสมเด็จพระพุทธเลิศหล้า||หน้า {PAGENO}/{nbpg}');
        $this->pdfService->setFooter('||วันที่พิมพ์ : ' . $dateExport . ' ' . $timeExport);
        $this->pdfService->addContent('pdf.replacementTemplatePage2', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }

    public function ContactPDF($id)
    {
        $Plan = DB::table('PDFแผนจ้างเหมาบริการ')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการครุภัณฑ์แผนจ้างเหมาบริการ')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.contactServiceTemplate', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }

    public function CalibrationPDF($id)
    {
        $Plan = DB::table('PDFแผนสอบเทียบเครื่องมือ')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการครุภัณฑ์แผนสอบเทียบเครื่องมือ')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.calibrationTemplate', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }

    public function PotentialPDF($id)
    {
        $Plan = DB::table('PDFแผนเพิ่มศักยภาพ')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการครุภัณฑ์แผนเพิ่มศักยภาพ')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.potentialTemplate', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }
    public function NoserialPDF($id)
    {
        $Plan = DB::table('PDFแผนไม่มีเลขครุภัณฑ์')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการไม่มีเลขครุภัณฑ์')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.noserialTemplate', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }
    public function POutsidewarehousePDF($id)
    {
        $Plan = DB::table('PDFแผนวัสดุนอกคลัง')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการแผนวัสดุนอกคลัง')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.POutsidewarehouseTemplate', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }
    public function PInsidewarehousePDF($id)
    {
        $Plan = DB::table('PDFแผนวัสดุในคลัง')->where('Plan_ID', $id)->first();
        $Plan_NAME = $Plan->Plan_NAME;
        $Plan_YEAR = $Plan->Plan_YEAR;
        $Plan_DEPT = $Plan->TCHN_LOCAT_NAME;
        $Plan_REASON = $Plan->Plan_REASON;
        $Total_Used = $Plan->Total_Used;

        $List_Equip = DB::table('PDFรายการแผนวัสดุในคลัง')->where('Equip_USED', 1)->where('Plan_ID', $id)->get();
        $tel = '';

        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');

        $Remaining_Price = $Plan->Total_Current_Price;
        $Remaining_Price_Text = $this->numberToThaiText($Remaining_Price);
        $data = [
            'id' => $id,
            'Plan_NAME' => $Plan_NAME,
            'Plan_YEAR' => $Plan_YEAR,
            'Plan_DEPT' => $Plan_DEPT,
            'Plan_REASON' => $Plan_REASON,
            'Total_Used' => $Total_Used,
            'Remaining_Price' => $Remaining_Price,
            'Remaining_Price_Text' => $Remaining_Price_Text,
            'List_Equip' => $List_Equip,
            'tel' => $tel,
            'dateExport' => $dateExport
        ];

        $this->pdfService->setWatermark('เอกสารราชการ รพ.สมเด็จฯลฯ ห้ามปลอมแปลง', 0.1);
        $this->pdfService->addContent('pdf.PInsidewarehouseTemplate', $data);
        return $this->pdfService->generateFromView($Plan_YEAR . '_' . $id . '-' . $datePDF);
    }

    protected function numberToThaiText($number, $include_unit = true, $display_zero = true)
    {
        $BAHT_TEXT_NUMBERS = ['ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
        $BAHT_TEXT_UNITS = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบล้าน', 'ร้อยล้าน'];
        $BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
        $BAHT_TEXT_TWENTY = 'ยี่';
        $BAHT_TEXT_INTEGER = 'ถ้วน';
        $BAHT_TEXT_BAHT = 'บาท';
        $BAHT_TEXT_SATANG = 'สตางค์';
        $BAHT_TEXT_POINT = 'จุด';

        if (!is_numeric($number)) {
            return null;
        }

        $log = floor(log($number, 10));
        if ($log > 5) {
            $millions = floor($log / 6);
            $million_value = pow(1000000, $millions);
            $normalised_million = floor($number / $million_value);
            $rest = $number - ($normalised_million * $million_value);
            $millions_text = '';
            for ($i = 0; $i < $millions; $i++) {
                $millions_text .= $BAHT_TEXT_UNITS[6];
            }
            return $this->numberToThaiText($normalised_million, false) . $millions_text . $this->numberToThaiText($rest, true, false);
        }

        $number_str = (string)floor($number);
        $text = '';
        $unit = 0;

        if ($display_zero && $number_str == '0') {
            $text = $BAHT_TEXT_NUMBERS[0];
        } else for ($i = strlen($number_str) - 1; $i > -1; $i--) {
            $current_number = (int)$number_str[$i];

            $unit_text = '';
            if ($unit == 0 && $i > 0) {
                $previous_number = isset($number_str[$i - 1]) ? (int)$number_str[$i - 1] : 0;
                if ($current_number == 1 && $previous_number > 0) {
                    $unit_text .= $BAHT_TEXT_ONE_IN_TENTH;
                } else if ($current_number > 0) {
                    $unit_text .= $BAHT_TEXT_NUMBERS[$current_number];
                }
            } else if ($unit == 1 && $current_number == 2) {
                $unit_text .= $BAHT_TEXT_TWENTY;
            } else if ($current_number > 0 && ($unit != 1 || $current_number != 1)) {
                $unit_text .= $BAHT_TEXT_NUMBERS[$current_number];
            }

            if ($current_number > 0) {
                $unit_text .= $BAHT_TEXT_UNITS[$unit];
            }

            $text = $unit_text . $text;
            $unit++;
        }

        if ($include_unit) {
            $text .= $BAHT_TEXT_BAHT;

            $satang = explode('.', number_format($number, 2, '.', ''))[1];
            $text .= $satang == 0
                ? $BAHT_TEXT_INTEGER
                : $this->numberToThaiText($satang, false) . $BAHT_TEXT_SATANG;
        } else {
            $exploded = explode('.', $number);
            if (isset($exploded[1])) {
                $text .= $BAHT_TEXT_POINT;
                $decimal = (string)$exploded[1];
                for ($i = 0; $i < strlen($decimal); $i++) {
                    $text .= $BAHT_TEXT_NUMBERS[$decimal[$i]];
                }
            }
        }

        return $text;
    }
}
