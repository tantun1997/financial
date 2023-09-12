<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;
use App\Models\User;

class CreateDeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('dept')->insert([
            [
                'deptName' => 'Administrator',
                'enable' => '0',
                'managerId' => '1',
                'manageDept' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'สำนักงานผู้อำนวยการ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ด้านอำนวยการ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ด้านบริการปฐมภูมิ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ฝ่ายการแพทย์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ด้านบริการทุติยภูมิและตติยภูมิ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ด้านการพยาบาล',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานบริหารทั่วไป',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานพัสดุ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานโครงสร้างพื้นฐานและวิศวกรรมทางการแพทย์ (ซ่อมบำรุง)',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานทรัพยากรบุคคล',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการเงิน',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานบัญชี',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ศูนย์สุขภาพชุมชนเมืองแม่กลอง',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ศูนย์สุขภาพชุมชนเมืองพระครูอุดมสมุทรคุณ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ศูนย์สุขภาพชุมชนเมืองเทพเจ้ากวนอู',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการแพทย์แผนไทยและการแพทย์ทางเลือก',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานเวชกรรมสังคม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานสุขศึกษา',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานอาชีวเวชกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลชุมชน',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'องค์กรแพทย์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานสารสนเทศทางการแพทย์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ศูนย์คอมพิวเตอร์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'เวชระเบียนนอก',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'เวชระเบียนใน',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานพัฒนาทรัพยากรบุคคล',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ห้องสมุด',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'โสตทัศนศึกษา',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานยุทธศาสตร์และแผนงานโครงการ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานพัฒนาคุณภาพและมาตรฐาน',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กิจกรรมบำบัด',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานกุมารเวชกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานโสต ศอ นาสิก',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานจักษุวิทยา',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานโภชนศาสตร์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานสูติ-นรีเวชกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานวิสัญญีวิทยา',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานจิตเวชและยาเสพติด',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานทันตกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานรังสีวิทยา',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานเทคนิคการแพทย์และพยาธิวิทยาคลินิก',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานเวชกรรมฟื้นฟู',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานสังคมสงเคราะห์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานเภสัชกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยอุบัติเหตุและฉุกเฉิน',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'หอผู้ป่วยพิเศษกาญจนาภิเษก',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'งานฝากครรภ์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'หน่วยจ่ายกลาง',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'ศูนย์เครื่องมือแพทย์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยหนักอายุรกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยนอก',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยหนักศัลยกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้คลอด',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยห้องผ่าตัด',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลวิสัญญี',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยอายุรกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยศัลยกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยสูติ-นรีเวช',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยกุมารเวชกรรม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลผู้ป่วยออร์โธปิดิกส์',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลด้านการควบคุม',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานการพยาบาลตรวจรักษาพิเศษ',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'deptName' => 'กลุ่มงานวิจัยและพัฒนาการพยาบาล',
                'enable' => '1',
                'managerId' => '1',
                'manageDept' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
