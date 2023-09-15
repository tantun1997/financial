<!DOCTYPE html>
<html lang="th">
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-size: 16pt;
            color: #000;
            direction: ltr;
        }
        td {
            line-height: 26px;
        }
        .header td {
            line-height: 26px;
        }
        strong {
            font-weight: bold;
        }
        .headerText {
            font-size: 19pt;
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
        </style>
</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table width="100%" class="header" style="vertical-align: bottm; padding-bottom: 5px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="1px"><img src="{{ asset('assets/img/logo.png') }}" width="46" height="51" alt=""/></td>
                        <td align="center"><strong style="font-size: 26pt">บันทึกข้อความ</strong></td>
                    </tr>
                </table>
                <table width="100%" class="header" border="0" style="vertical-align: top;">
                    <tr>
                        <td width="1px"><p class="headerText">ส่วนราชการ</p></td>
                        <td>
                            <table width="100%" class="header" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="table_doted_left">กลุ่มงาน/ฝ่าย/งาน&nbsp;กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="18%">
                            <table width="100%" class="header" border="0" cellspacing="0" cellpadding="0" style="vertical-align: top;">
                                <tr>
                                    <td width="1px">โทร</td>
                                    <td class="table_doted_left">&nbsp; 2703 &nbsp;</td>
                                </tr>
                        </table>
                    </td>
                    </tr>
                </table>
                <table width="100%" class="header" border="0" style="vertical-align: top;">
                    <tr>
                        <td width="1px"><p class="headerText">ที่</p></td>
                        <td class="table_doted_left">&nbsp; สส 0032./ &nbsp;</td>
                        <td width="38%">
                            <table width="100%" class="header" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="1px"><p class="headerText">วันที่</p></td>
                                    <td class="table_doted_center">&nbsp; 12 พฤศจิกายน 2566 &nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" class="header" style="vertical-align: top; padding-bottom: 10px;">
                    <tr>
                        <td width="1px"><p class="headerText">เรื่อง</p></td>
                        <td class="table_doted_left">&nbsp; ขออนุมัติในหลักการจัดซื้อ/จัดจ้าง &nbsp;</td>
                    </tr>
                </table>
                <table width="100%" border="0" class="header" style="vertical-align: bottom; padding-bottom: 10px;">
                    <tr>
                        <td width="1px">เรียน</td>
                        <td>ผู้อำนวยการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า &nbsp;</td>
                    </tr>
                </table>
                <table width="100%" border="0" style="vertical-align: bottom;">
                    <tr>
                        <td><span style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ด้วยกลุ่มงาน/ฝ่าย/งาน&nbsp;กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก&nbsp;ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี 2567 โดยมีรายละเอียดดังนี้</span></td>
                    </tr>
                </table>


                {{-- <table width="100%" border="0" style="vertical-align: bottom;">
                    <tr>
                        <td width="15%"></td>
                        <td width="1px">ด้วยกลุ่มงาน/ฝ่าย/งาน</td>
                        <td class="text_doted_left">&nbsp; กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก &nbsp;</td>
                    </tr>
                </table>
                <table width="100%" border="0" style="vertical-align: bottom; padding-bottom: 10px;">
                    <tr>
                        <td width="57%">ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี </td>
                        <td width="15%" class="text_doted_center">&nbsp; 2567 &nbsp;</td>
                        <td>โดยมีรายละเอียดดังนี้</td>
                    </tr>
                </table>
                <table width="100%" border="0" style="vertical-align: top;">
                    <tr>
                        <td width="18%" style="text-align: right">1.</td>
                        <td width="12%">ชื่อแผนงาน</td>
                        <td>จัดซื้อคุรุภัณฑ์คอมพิวเตอร์ประจำปี 2566 จัดซื้อคุรุภัณฑ์คอมพิวเตอร์ประจำปี 2566 จัดซื้อคุรุภัณฑ์คอมพิวเตอร์ประจำปี 2566</td>
                    </tr>
                </table>
                <table width="100%" border="0" style="vertical-align: top; padding-bottom: 10px;">
                    <tr>
                        <td width="18%"></td>
                        <td width="12%">โครงการ</td>
                        <td>จัดซื้อคุรุภัณฑ์คอมพิวเตอร์ประจำปี 2566</td>
                    </tr>
                </table> --}}
            </td>
        </tr>
    </table>

</body>
</html>
