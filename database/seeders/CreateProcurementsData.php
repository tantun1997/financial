<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;

class CreateProcurementsData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('procurement_type')->insert([
            [
                'typeName' => 'แผนฯบำรุงรักษา/ซ่อม',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'typeName' => 'แผนฯจ้างเหมาบริการ',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        DB::table('procurement_object')->insert([
            [
                'procurementTypeId' => '1',
                'objectName' => 'บำรุงรักษา',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ซ่อมแซม',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าธรรมเนียมรายปี',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมอาคารและสิ่งปลูกสร้าง',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์สำนักงาน',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์ยานพาหนะและขนส่ง',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์โฆษณาและเผยแพร่',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์วิทยาศาสตร์และการแพทย์',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์คอมพิวเตอร์',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์อื่น(งานบ้าน)',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์อื่น(ก่อสร้าง)',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์อื่น',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์วัสดุการแพทย์',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '1',
                'objectName' => 'ค่าซ่อมแซมครุภัณฑ์วัสดุอื่น',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาบำรุงรักษาดูแลลิฟท์',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาบำรุงรักษาครุภัณฑ์วิทยาศาสตร์และการแพทย์',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาบำรุงรักษาครุภัณฑ์อื่น',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาซักรีด',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมากำจัดขยะติดเชื้อ',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาบริการทางการแพทย์',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาบำรุงรักษาต่ออายุธรรมเนียมรายปี',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างเหมาบริการอื่น(สนับสนุน)',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าปรับปรุงสถานที่',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างตรวจทางห้องปฏิบัติการ (Lab)',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'procurementTypeId' => '2',
                'objectName' => 'ค่าจ้างตรวจเอ็กซเรย์(X-Ray)',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        DB::table('procurements')->insert([
            [
                'procurementType' => '1',
                'priorityNo' => '1',
                'listNo' => '1',
                'unitPrice' => '1590',
                'unitName' => 'ชิ้น',
                'amount' => '1',
                'objectTypeId' => '4',
                'reason' => 'ทดสอบระบบ',
                'deptId' => '26',
                'year' => '2567',
                'time' => '1',
                'note' => 'ทดสอบระบบ',
                'userId' => '1',
                'enable' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
