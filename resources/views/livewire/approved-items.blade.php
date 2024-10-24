<div class="container-fluid">
    <h3 class="mt-3 mb-3"><i class="fa-regular fa-clipboard"></i> รายการขออนุมัติ</h3>
    <div class="card mb-4">
        <div class="card-body">
            <table id='dataTable' class="table table-bordered table-hover table-sm" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">ชื่อแผนงาน</th>
                        <th class="text-center">ประเมินราคา</th>
                        <th class="text-center">เหตุผลและความจำเป็น</th>
                        <th class="text-center">เพิ่มเติม</th>
                        <th class="text-center" style="width: 5%">จัดการ</th>
                        <th style="display: none">เลขที่แผน</th>
                        <th style="display: none">ชื่อแผน</th>
                        <th style="display: none">ปีงบประมาณ</th>
                        <th style="display: none">ประเภทแผน</th>
                        <th style="display: none">แผนฯ</th>
                        <th style="display: none">วงเงินรวม</th>
                        <th style="display: none">เหตุผล</th>
                        <th style="display: none">แผนก</th>
                        <th style="display: none">เพิ่มครุภัณฑ์แล้ว</th>
                        <th style="display: none">ราคาประเมินจริงรวมทั้งหมด</th>
                        <th style="display: none">คงเหลือ</th>
                        <th style="display: none;">Approved</th>
                        <th style="display: none;">ประเภทงบ</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($EQUIPMENT_PLAN as $item)
                        <tr>
                            <td
                                style="word-break: break-all; max-width: 500px; @if ($item->Plan_LEVEL != 1) background-color: #9999; @endif">
                                <small>เลขที่แผน: ผ.{{ $item->Plan_ID }} <br>
                                    ชื่อแผน: {{ $item->Plan_NAME }}<br>
                                    ปีงบประมาณ: {{ $item->Plan_YEAR }} <br>
                                    แผนฯ: {{ $item->LEVEL_NAME }} <br>
                                    ประเภทงบ: {{ $item->Budget }}
                                </small>

                            </td>
                            <td
                                style="white-space: nowrap; max-width: 500px;@if ($item->Plan_LEVEL != 1) background-color: #9999; @endif">
                                <small><span style="color: rgb(42, 96, 243)">วงเงินรวม:
                                        {{ number_format(round($item->Plan_PRICE_OVERALL * $item->Plan_AMOUNT, 2), 2) }}
                                        บาท</span>
                                    <br>จำนวนครุภัณฑ์ที่ตั้งไว้: {{ number_format(round($item->Plan_AMOUNT, 2), 0) }}
                                    @if ($item->Total_Used === null || $item->Total_Used == 0)
                                        <br> เพิ่มครุภัณฑ์แล้ว: -
                                        <br> ใช้ไปแล้ว: - บาท
                                        <br> คงเหลือ: - บาท
                                    @else
                                        <br> เพิ่มครุภัณฑ์แล้ว: {{ $item->Total_Used }}
                                        <br>ใช้ไปแล้ว:<span style="color: red">
                                            {{ number_format(round($item->Total_Current_Price, 2), 2) }}
                                        </span>บาท
                                        <br><span style="color: green">คงเหลือ:
                                            {{ number_format(round($item->Remaining_Price, 2), 2) }}
                                            บาท</span>
                                    @endif
                                </small>
                            </td>
                            <td
                                style="word-break: break-all; max-width: 500px; @if ($item->Plan_LEVEL != 1) background-color: #9999; @endif">
                                <small> {{ $item->Plan_REASON }}
                                </small>
                            </td>
                            <td
                                style="text-align: left; max-width: 300px; @if ($item->Plan_LEVEL != 1) background-color: #9999; @endif">
                                <small>
                                    วันที่สร้างแผน {{ $item->Plan_DATE }} <br>
                                    หน่วยงานที่เบิก: {{ $item->TCHN_LOCAT_NAME }}
                                </small>
                            </td>
                            <td style="white-space: nowrap; text-align: center;">
                                <a class="btn btn-outline-primary btn-sm"
                                    href="http://192.168.2.142/maintenance_equip/detail?id={{ $item->Plan_ID }}">ดูข้อมูล</a>
                                @if (Auth::user()->id == '114000041')
                                    <br><br>
                                    <button type="button" wire:click="approved({{ $item->Plan_ID }})"
                                        class="btn btn-success btn-sm">อนุมัติ</button>
                                    <button type="button" wire:click="disapproved({{ $item->Plan_ID }})"
                                        class="btn btn-secondary btn-sm">ไม่อนุมัติ</button>
                                @endif
                                <br>
                                @if ($item->Plan_ENABLE == 1)
                                    @if (Auth::user()->id != '114000041')
                                        @if ($item->Plan_ENABLE == 1 && $item->Plan_REQUEST_APPROVAL == 1)
                                            <span class="badge bg-secondary">ส่งขออนุมัติแล้ว</span><br>
                                        @elseif($item->Plan_ENABLE == 1)
                                            <span class="badge bg-warning text-dark">รออนุมัติ</span>
                                        @else
                                            <button type="button" wire:click="requset_approved({{ $item->Plan_ID }})"
                                                class="btn btn-primary btn-sm">ส่งขออนุมัติ</button>
                                        @endif
                                    @endif
                                @elseif($item->Plan_ENABLE == 2)
                                    <span class="badge bg-success">อนุมัติแล้ว</span>
                                @elseif($item->Plan_ENABLE == 3)
                                    <span class="badge bg-danger">ไม่อนุมัติ</span>
                                @endif
                            </td>
                            <td style="display: none">{{ $item->Plan_ID }}</td>
                            <td style="display: none">{{ $item->Plan_NAME }}</td>

                            <td style="display: none">{{ $item->Plan_YEAR }}</td>
                            <td style="display: none">{{ $item->TYPE_NAME }}</td>
                            <td style="display: none">{{ $item->LEVEL_NAME }}</td>
                            <td style="display: none">
                                {{ number_format(round($item->Plan_PRICE_OVERALL * $item->Plan_AMOUNT, 2), 2) }}
                            </td>
                            <td style="display: none">{{ $item->Plan_REASON }}</td>
                            <td style="display: none">{{ $item->TCHN_LOCAT_NAME }}</td>
                            <td style="display: none">{{ $item->Total_Used }}</td>
                            <td style="display: none;">{{ $item->Total_Current_Price }}</td>
                            <td style="display: none;">{{ $item->Remaining_Price }}</td>
                            <td style="display: none;">
                                @if ($item->Plan_ENABLE == 1)
                                    รออนุมัติ
                                @elseif($item->Plan_ENABLE == 2)
                                    อนุมัติแล้ว
                                @elseif($item->Plan_ENABLE == 3)
                                    ไม่อนุมัติ
                                @endif
                            </td>
                            <td style="display: none;">{{ $item->Budget }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .breadcrumb a {
            text-decoration: none;
            color: #000000;
        }
    </style>

    <script>
        initializeDataTable()

        var table

        function initializeDataTable() {
            table = $('#dataTable').DataTable({
                language: {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง _MENU_ รายการ",
                    "sZeroRecords": "ไม่พบข้อมูลในตาราง",
                    "sEmptyTable": "ไม่มีข้อมูลในตาราง",
                    "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
                    "sInfoFiltered": "(กรองข้อมูลทั้งหมด _MAX_ รายการ)",
                    "sSearch": "ค้นหา:",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "กำลังโหลด...",
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sLast": "หน้าสุดท้าย",
                        "sNext": "ถัดไป",
                        "sPrevious": "ก่อนหน้า"
                    }
                },
                autoWidth: true,
                searching: true,
                responsive: true,
                // scrollX: true,
                // scrollY: '65vh',
                // scrollCollapse: true,
                ordering: true,
                order: [],
                lengthMenu: [
                    [-1, 10, 50, 100],
                    ['ทั้งหมด', '10', '50', '100']
                ],
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯบำรุงรักษา',
                    title: `รายงานแผนฯบำรุงรักษา หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [5, 6, 7, 17, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                    },
                    className: 'btn btn-outline-success', // เพิ่มคลาส CSS เพื่อปรับแต่งสีปุ่ม
                    init: function(api, node, config) {
                        $(node).removeClass(
                            'dt-button'); // ลบคลาสเดิมของ DataTables ออกเพื่อปรับแต่งสีตามคลาสที่กำหนด
                    }
                }]
            });
        }
        var excelButton = table.buttons(); // 0 คือ index ของปุ่ม "Export to Excel"
        excelButton.container().appendTo(
            '#newButtonContainer'); // เปลี่ยน #newButtonContainer เป็น selector ของตำแหน่งที่ต้องการ

        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                urls: event.detail.urls,
                timer: 2000,
            }).then(function() {
                window.location.href = event.detail.urls;
            });
        });

        window.addEventListener('swal:confirm', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.livewire.emit('deleteConfirmed', event.detail.id);
                }
            });
        });
    </script>

</div>
