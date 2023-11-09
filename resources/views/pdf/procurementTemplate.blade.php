<!DOCTYPE html>
<html lang="th">

<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-size: 11pt;
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
            font-size: 13pt;
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
            <td class="table_doted_left">
                กลุ่มงาน/ฝ่าย/งาน&nbsp;{{ $department }}&nbsp;&nbsp;&nbsp;โทร.&nbsp;{{ $tel }}&nbsp;</td>
        </tr>
    </table>
    <table width="100%" class="header" border="0" style="vertical-align: top;">
        <tr>
            <td width="30px" class="headerText">ที่</td>
            <td class="table_doted_left">สส 0033/ผ.{{ $id }}</td>
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
            <td class="textecho">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยกลุ่มงาน/ฝ่าย/งาน
                @if (strlen($department) > 30 && strlen($department) <= 80)
                    {{ $department }}
                    ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ <br>
                    ประจำปี {{ $years }} โดยมีรายละเอียดดังนี้
                @elseif(strlen($department) > 100)
                    {{ $department }} ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี {{ $years }}
                    โดยมีรายละเอียดดังนี้
                @else
                    {{ $department }} ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี {{ $years }}
                    โดยมีรายละเอียดดังนี้
                @endif
            </td>
        </tr>
    </table>

    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">1.</td>
            <td width="75px">ชื่อแผนงาน</td>
            <td class="textecho">{{ $planName }}</td>
        </tr>

    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">2.</td>
            <td class="textecho">เหตุผลความจำเป็นที่จะจัดซื้อ/จัดจ้าง คือ&nbsp;{{ $reason }}</span>
        </tr>
    </table>

    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">3.</td>
            <td class="textecho">
                @php
                    $count = 0;
                @endphp
                @foreach ($vwReportEquipDetail as $detail)
                    @if ($detail->PROC_ID > 0)
                        @php
                            $count++;
                        @endphp
                    @endif
                @endforeach
                รายละเอียดของงานที่จะซื้อ/จ้าง จำนวน&nbsp;{{ $count }}&nbsp;รายการ&nbsp;ดังนี้
                ตามเอกสารแนบ
            </td>

        </tr>
        <tr>
            <td colspan="3">
                <table width="100%" border="0" style="vertical-align: top;">
                    <tr>
                        <td width="70px">&nbsp;</td>
                        <td class="textecho">
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($vwReportEquipDetail as $item)
                                @if ($item->PROC_ID > 0)
                                    {{ $count }}. {{ $item->EQUP_NAME }}
                                    @if (strpos($item->EQUP_NAME, 'ราคา') === false &&
                                            strpos($item->EQUP_NAME, 'บาท') === false &&
                                            strpos($item->EQUP_NAME, 'x') === false)
                                        ราคา {{ $item->count_equp }}x{{ number_format($item->currentPrice) }}
                                        บาท<br>
                                    @endif
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            @endforeach
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">4.</td>
            <td class="textecho">
                วงเงินที่จะซื้อ/จ้าง&nbsp;{{ number_format($totalPrice) }}&nbsp;บาท&nbsp;(&nbsp;{{ $totalPriceText }}&nbsp;)
            </td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50px">&nbsp;</td>
            <td width="5px">5.</td>
            <td>เอกสารแนบท้าย</td>
        </tr>
        <tr>
            <td colspan="3">
                <table width="100%" border="0" style="vertical-align: bottom; padding-bottom: 3px;">
                    <tr>
                        <td width="70px">&nbsp;</td>
                        <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}" width="23"
                                height="23" alt="" /></td>
                        <td width="75px">ใบส่งซ่อม</td>
                        <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}" width="23"
                                height="23" alt="" /></td>
                        <td width="85px">แคตตาล็อค</td>
                        <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}" width="23"
                                height="23" alt="" /></td>
                        <td width="95px">ใบเสนอราคา</td>
                        <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}" width="23"
                                height="23" alt="" /></td>
                        <td>อื่น ๆ ....................</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: bottom; padding-bottom: 3px;">
        <tr>
            <td width="105px">&nbsp;</td>
            <td>จึงเรียนมาเพื่อโปรดพิจารณา</td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
        <tr>
            <td width="50%">
                <br>
                <table width="100%" border="0"
                    style="vertical-align: top; padding-bottom: 3px; font-size: 10pt;">
                    <tr>
                        <td colspan="2">หน.กลุ่มภารกิจ/กลุ่มงาน ตรวจสอบแล้ว อยู่ใน</td>
                    </tr>
                    <tr>
                        <td width="10px"><img src="{{ asset('assets/img/true_blue.png') }}" width="20"
                                height="20" alt="" /></td>
                        <td>แผนเงินบำรุง/งบประมาณ ปี {{ $years }}</td>
                    </tr>
                    <tr>
                        <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}" width="20"
                                height="20" alt="" /></td>
                        <td>ไม่อยู่ในแผน / เหตุผลความจำเป็น</td>
                    </tr>
                    <tr>
                        <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}" width="20"
                                height="20" alt="" /></td>
                        <td>วงเงินในแผน คงเหลือ</td>
                    </tr>
                    <tr>
                        <td width="10px">&nbsp;</td>
                        <td style="vertical-align: top;">
                            <table width="100%" border="0" style="vertical-align: top;">
                                <tr>
                                    <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}"
                                            width="20" height="20" alt="" /></td>
                                    <td>เพียงพอ</td>
                                    <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}"
                                            width="20" height="20" alt="" /></td>
                                    <td>ไม่เพียงพอ</td>
                                    <td>&nbsp;เห็นควรดำเนินการ</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <table width="80%" border="0" style="vertical-align: top; padding-bottom: 3px;">
                                <tr>
                                    <td width="1px">&nbsp;</td>
                                    <td class="text_doted_left">&nbsp;</td>
                                    <td width="1px">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>(</td>
                                    <td class="text_doted_left">&nbsp;</td>
                                    <td>)</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text_doted_left">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table width="100%" border="0" style="vertical-align: top; padding-bottom: 60px;">
                    <tr>
                        <td width="45px">ลงชื่อ</td>
                        <td class="text_doted_left">&nbsp;</td>
                        <td width="120px">(หัวหน้ากลุ่มงาน)</td>
                    </tr>
                    <tr>
                        <td width="45px" style="text-align: right;">(</td>
                        <td class="text_doted_left">&nbsp;</td>
                        <td width="120px">)</td>
                    </tr>
                </table>
                <table width="100%" border="0" style="vertical-align: top; padding-bottom: 3px;">
                    <tr>
                        <td style="text-align: center;">ผู้อำนวยการ/ผู้ได้รับมอบหมาย</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <table width="90%" border="0" style="vertical-align: top;">
                                <tr>
                                    <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}"
                                            width="20" height="20" alt="" /></td>
                                    <td width="50px" style="text-align: left;">อนุมัติ</td>
                                    <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}"
                                            width="20" height="20" alt="" /></td>
                                    <td style="text-align: left;">ไม่อนุมัติ</td>
                                </tr>
                                <tr>
                                    <td width="10px"><img src="{{ asset('assets/img/true_box.png') }}"
                                            width="20" height="20" alt="" /></td>
                                    <td colspan="3" class="text_doted_left">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <table width="100%" border="0"
                                            style="vertical-align: top; padding-bottom: 3px;">
                                            <tr>
                                                <td width="1px">&nbsp;</td>
                                                <td class="text_doted_left">&nbsp;</td>
                                                <td width="1px">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>(</td>
                                                <td class="text_doted_left">&nbsp;</td>
                                                <td>)</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <table width="100%" border="0"
                                                        style="vertical-align: top; padding-bottom: 3px;">
                                                        <tr>
                                                            <td width="33%" class="text_doted_left"
                                                                style="text-align: right;">&nbsp;/</td>
                                                            <td class="text_doted_left" style="text-align: right;">
                                                                &nbsp;/</td>
                                                            <td width="33%" class="text_doted_left">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>




</body>

</html>
