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

    public function generateProcurement($id)
    {
        $query = DB::table('VW_NEW_MAINPLAN')->where('id', $id)->first();

        $vwCountDetail = DB::table('vwCountDetail')->where('PROC_ID', $id)->where('used', 1)->first();

        $vwCountDetailText = optional($vwCountDetail)->count_detail ?? '0';

        $vwEquipDetail = DB::table('vwEquipDetail')->where('PROC_ID', $id)->get();

        $pattern = '/ประจำปี\s+\d{4}/';
        $replacement = ' ประจำปี ' . $query->budget;

        $vwReportEquipDetail = DB::table('vwReportEquipDetail')->where('PROC_ID', $id)->orderBy('EQUP_ID', 'asc')->get();
        $title = 'บันทึกข้อความ';
        $department = $query->TCHN_LOCAT_NAME;
        $tel = '';
        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $timeExport = Carbon::now()->format('H:i:s');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');
        $subject = 'ขออนุมัติในหลักการจัดซื้อ/จัดจ้าง';
        // $planName = $query->description . ' ประจำปี ' . $query->budget;
        if (preg_match($pattern, $query->description)) {
            $planName = preg_replace($pattern, $replacement, $query->description);
            $planName = preg_replace('/^\d+\./', '', $planName);

        } else {
            $planName = preg_replace('/^\d+\./', '', $query->description);
            $planName = $planName . ' ประจำปี ' . $query->budget;
        }
        $projectName = '';
        $years = $query->budget;
        $reason = $query->reason;
        $quant = $query->quant;
        $price = $query->price;
        $totalPrice = $vwCountDetailText * $price;
        $totalPriceText = $this->numberToThaiText($totalPrice);
        // dd($planName);

        $data = [
            'id' => $id,
            'title' => $title,
            'department' => $department,
            'tel' => $tel,
            'dateExport' => $dateExport,
            'subject' => $subject,
            'planName' => $planName,
            'projectName' => $projectName,
            'reason' => $reason,
            'quant' => $quant,
            'price' => $price,
            'totalPrice' => $totalPrice,
            'totalPriceText' => $totalPriceText,
            'years' => $years,
            'vwEquipDetail' => $vwEquipDetail,
            'vwReportEquipDetail' => $vwReportEquipDetail,
            'vwCountDetail' => $vwCountDetail,
            'vwCountDetailText' => $vwCountDetailText,

        ];

        $this->pdfService->addContent('pdf.procurementTemplate', $data);
        $this->pdfService->addNewPage('L', '', '1', '', '', '10', '10', '20', '20', '5', '5', '', '', '', '', '', '', '', '', '', 'A4');
        $this->pdfService->setHeader('โรงพยาบาลสมเด็จพระพุทธเลิศหล้า||หน้า {PAGENO}/{nbpg}');
        $this->pdfService->setFooter('||วันที่พิมพ์ : ' . $dateExport . ' ' . $timeExport);
        $this->pdfService->addContent('pdf.procurementTemplatePage2', $data);
        return $this->pdfService->generateFromView($years . '_' . $id . '-' . $datePDF);
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

    public function generateContactService($id)
    {
        $query = DB::table('VW_NEW_MAINPLAN')->where('id', $id)->first();
        $pattern = '/ประจำปี\s+\d{4}/';
        $replacement = ' ประจำปี ' . $query->budget;

        $title = 'บันทึกข้อความ';
        $department = $query->TCHN_LOCAT_NAME;
        $tel = '';
        $dateExport = Carbon::now()->addYears(543)->translatedFormat('d F Y');
        $datePDF = Carbon::now()->addYears(543)->translatedFormat('Ymd');
        $subject = 'ขออนุมัติในหลักการจัดซื้อ/จัดจ้าง';
        if (preg_match($pattern, $query->description)) {
            $planName = preg_replace($pattern, $replacement, $query->description);
            $planName = preg_replace('/^\d+\./', '', $planName);
        } else {
            $planName = preg_replace('/^\d+\./', '', $query->description);
            $planName = $planName . ' ประจำปี ' . $query->budget;
        }
        // $projectName = $query->description;
        if (preg_match($pattern, $query->description)) {
            $projectName = preg_replace($pattern, '',$query->description);
            $projectName = preg_replace('/^\d+\./', '', $projectName);
        } else {
            $projectName = preg_replace('/^\d+\./', '', $query->description);
        }
        $years = $query->budget;
        $reason = $query->reason;
        $quant = $query->quant;
        $price = $query->price;
        $totalPrice = $quant * $price;
        $totalPriceText = $this->numberToThaiText($totalPrice);


        $data = [
            'id' => $id,
            'title' => $title,
            'department' => $department,
            'tel' => $tel,
            'dateExport' => $dateExport,
            'subject' => $subject,
            'planName' => $planName,
            'projectName' => $projectName,
            'reason' => $reason,
            'quant' => $quant,
            'price' => $price,
            'totalPrice' => $totalPrice,
            'totalPriceText' => $totalPriceText,
            'years' => $years,
        ];

        $this->pdfService->addContent('pdf.contactServiceTemplate', $data);
        return $this->pdfService->generateFromView($years . '_' . $id . '-' . $datePDF);
    }
}
