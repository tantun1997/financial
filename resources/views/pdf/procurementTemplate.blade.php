<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-size: 16pt;
            color: #000;
        }
        td {
            height: 20px;
        }
        strong {
            font-weight: bold;
        }
        .headerText {
            font-size: 19pt;
            font-weight: bold;
        }
        .text_doted {
            border-bottom: 1px dotted #999;
            text-align: center;
            text-decoration: none;
        }
        .text_doted_left {
            border-bottom: 1px dotted #999;
            text-align: left;
            text-decoration: none;
        }
        </style>
</head>
<body>
    <table width="100%" style="vertical-align: bottom; padding-bottom: 5px;">
        <tr>
            <td width="1px"><img src="{{ asset('assets/img/logo.png') }}" width="46" height="51" alt=""/></td>
            <td align="center"><strong style="font-size: 26pt">บันทึกข้อความ</strong></td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: bottom;">
        <tr>
            <td width="1px"><p class="headerText">ส่วนราชการ</p></td>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="1px">กลุ่มงาน/ฝ่าย/งาน</td>
                        <td class="text_doted_left">&nbsp; กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก &nbsp;</td>
                    </tr>
                </table>
            </td>
            <td width="18%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="1px">โทร</td>
                        <td class="text_doted_left">&nbsp; 2703 &nbsp;</td>
                    </tr>
            </table>
        </td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: bottom;">
        <tr>
            <td width="1px"><p class="headerText">ที่</p></td>
            <td class="text_doted_left">&nbsp; สส 0032./ &nbsp;</td>
            <td width="38%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="1px" class="headerText">วันที่</td>
                        <td class="text_doted">&nbsp; 12 พฤศจิกายน 2566 &nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: bottom;">
        <tr>
            <td width="1px"><p class="headerText">เรื่อง</p></td>
            <td class="text_doted_left">&nbsp; ขออนุมัติในหลักการจัดซื้อ/จัดจ้าง &nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: bottom; padding-top: 10px; padding-bottom: 10px;">
        <tr>
            <td width="1px">เรียน</td>
            <td>&nbsp; ผู้อำนวยการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า &nbsp;</td>
        </tr>
    </table>
    <span>ด้วยกลุ่มงาน/ฝ่าย/งาน<span class="text_doted_left">&nbsp;&nbsp;&nbsp; กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก &nbsp;&nbsp;&nbsp;</span>
        ได้รับอนุมัติให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี<span class="text_doted">&nbsp;&nbsp;&nbsp; 2566 &nbsp;&nbsp;&nbsp;</span>
        โดยมีรายละเอียดดังนี้</span>



    {{-- <table width="100%" border="0" style="vertical-align: bottom;">
        <tr>
            <td width="1px" style="padding-left: 100px;">ด้วยกลุ่มงาน/ฝ่าย/งาน</td>
            <td class="text_doted">&nbsp; กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก &nbsp;</td>
            <td width="15%">&nbsp; ได้รับอนุมัติ &nbsp;</td>
        </tr>
    </table> --}}
    {{-- <table width="100%" border="0" style="vertical-align: bottom;">
        <tr>
            <td width="48%">ให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี</td>
            <td class="text_doted">&nbsp; 2566 &nbsp;</td>
            <td width="25%">&nbsp; โดยมีรายละเอียดดังนี้ &nbsp;</td>
        </tr>
    </table>
    <p class="text_doted_left">ให้ดำเนินการตามแผน เงินบำรุง/งบประมาณ ประจำปี</p> --}}
</body>
</html>
