<!DOCTYPE html>
<html lang="th">

<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-size: 12pt;
            color: #000;
            direction: ltr;
            font-family: "garuda", sans-serif;
        }

        td {
            line-height: 23px;
        }

        .header td {
            line-height: 27px;
        }

        strong {
            font-weight: bold;
        }

        .headerText {
            font-size: 14pt;
            font-weight: bold;

        }
        .table_doted_left {
            border-bottom: 1px dotted #999;
            text-align: left;
            text-decoration: none;
        }

        .table_doted_center {
            border-bottom: 1px dotted #999;
            text-align: center;
            text-decoration: none;
        }

        .text_doted_left {
            border-bottom: 1px dotted #999;
            text-align: left;
            text-decoration: none;
        }

        .text_doted_center {
            border-bottom: 1px dotted #999;
            text-align: center;
            text-decoration: none;
        }
        .textecho {
            overflow: auto;
            word-break: keep-all;
            text-align: justify;
            letter-spacing: normal;
            word-spacing: normal;
            white-space: normal;
            text-indent: 50px;
        }
    </style>
</head>

<body>
    <table width="100%" class="header" style="vertical-align: bottom; padding-bottom: 5px;" cellspacing="0"
        cellpadding="0">
        <tr>
            <td width="1px"><img src="{{ asset('assets/img/logo.png') }}" width="46" height="51"
                    alt="" /></td>
            <td align="center"><strong style="font-size: 19pt">บันทึกข้อความ</strong></td>
        </tr>
    </table>
    <table width="100%" class="header" border="0" style="vertical-align: bottom;">
        <tr>
            <td width="110px" class="headerText">ส่วนราชการ</td>
            <td class="table_doted_left">กลุ่มงาน/ฝ่าย/งาน&nbsp;{{ $department }}&nbsp;&nbsp;&nbsp;โทร.&nbsp;{{ $tel }}&nbsp;</td>
        </tr>
    </table>
    <table width="100%" class="header" border="0" style="vertical-align: top;">
        <tr>
            <td width="30px" class="headerText">ที่</td>
            <td class="table_doted_left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="50px" class="headerText">วันที่</td>
            <td width="170px" class="table_doted_center">&nbsp; {{ $dateExport }} &nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" class="header" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px" class="headerText">เรื่อง</td>
            <td class="table_doted_left">&nbsp; {{ $subject }} &nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" class="header" style="vertical-align: bottom; padding-bottom: 3px;">
        <tr>
            <td width="45px">เรียน</td>
            <td>ผู้อำนวยการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า &nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td class="textecho">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยกลุ่มงาน/ฝ่าย/งาน {{ $department }}
                    ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี 2567
                    โดยมีรายละเอียดดังนี้</td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">1.</td>
            <td width="85px">ชื่อแผนงาน</td>
            <td class="textecho">{{ $planName }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>โครงการ</td>
            <td><span class="textecho">{{ $projectName }}</span></td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">2.</td>
            <td class="textecho">เหตุผลความจำเป็นที่ต้องจัดซื้อ/จัดจ้าง คือ&nbsp;{{ $reason }}</span>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">3.</td>
            <td class="textecho">รายละเอียดของงานที่จะซื้อ/จ้าง จำนวน&nbsp;{{ $totalQuant }}&nbsp;รายการ&nbsp;ดังนี้</td>
        </tr>
        <tr>
            <td colspan="3"><table width="100%" border="0" style="vertical-align: top;">
                <tr>
                    <td width="70px">&nbsp;</td>
                    <td width="5px">1.</td>
                    <td class="textecho">MA ระบบบริหารจัดการคิว</td>
                    <td width="50px">จำนวน</td>
                    <td class="textecho">&nbsp;{{ $quant }}&nbsp;x&nbsp;{{ $price }}</td>
                </tr>
                <tr>
                    <td width="70px">&nbsp;</td>
                    <td width="5px" colspan="4">เป็นเงิน&nbsp;&nbsp;{{ $sumprice }}&nbsp;&nbsp;บาท</td>
                </tr>
                <tr>
                    <td width="70px">&nbsp;</td>
                    <td width="5px">2.</td>
                    <td class="textecho">MA ระบบบริหารจัดการคิว</td>
                    <td width="50px">จำนวน</td>
                    <td class="textecho">&nbsp;{{ $quant }}&nbsp;x&nbsp;{{ $price }}</td>
                </tr>
                <tr>
                    <td width="70px">&nbsp;</td>
                    <td width="5px" colspan="4">เป็นเงิน&nbsp;&nbsp;{{ $sumprice }}&nbsp;&nbsp;บาท</td>
                </tr>
            </table></td>
        </tr>

    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">4.</td>
            <td class="textecho">วงเงินที่จะซื้อ/จ้าง&nbsp;{{ $totalPrice }}&nbsp;บาท&nbsp;(&nbsp;{{ $totalPriceText }}&nbsp;)</td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">5.</td>
            <td>เอกสารแนบท้าย</td>
        </tr>
        <tr>
            <td colspan="3"><table width="100%" border="0" style="vertical-align: top;">
                <tr>
                    <td width="70px">&nbsp;</td>
                    <td width="70px"><img src="{{ asset('assets/img/true_box.png') }}" width="23" height="23" alt="" /></td>
                    <td width="70px">&nbsp;s</td>
                    <td width="70px">&nbsp;s</td>
                    <td width="70px">&nbsp;s</td>
                    <td width="70px">&nbsp;s</td>
                    <td width="70px">&nbsp;s</td>
                    <td width="70px">&nbsp;s</td>
                    <td width="70px">&nbsp;s</td>
                </tr>
            </table></td>
        </tr>
    </table>

</body>
</html>
