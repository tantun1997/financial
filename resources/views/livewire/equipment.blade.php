<div class="container-fluid">
    <h3 class="mt-3 mb-3"><i class="fa-duotone fa-newspaper"></i> ครุภัณฑ์ทั้งหมด</h3>
    <hr>
    <div class="card mb-4">

        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>เลขครุภัณฑ์</label>
                        <select class="form-control select2" id="filterSelectID" style="width: 100%;" multiple>
                            <option value="">ทั้งหมด</option>
                            @foreach ($EQUP_ID as $EQUP_ID)
                                <option value="{{ $EQUP_ID }}">{{ $EQUP_ID }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>ชื่อครุภัณฑ์</label>
                        <select class="form-control select2" id="filterSelectName" style="width: 100%;" multiple>
                            <option value="">ทั้งหมด</option>
                            @foreach ($EQUP_NAME as $EQUP_NAME)
                                <option value="{{ $EQUP_NAME }}">{{ $EQUP_NAME }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>แผนก</label>
                        @if (Auth::user()->isAdmin == 'Y')
                            <select class="form-control select2" id="filterSelectLocat" style="width: 100%;" multiple>
                                <option value="" selected>ทั้งหมด</option>
                                @foreach ($TCHN_LOCAT_NAME as $TCHN_LOCAT_NAME)
                                    <option value="{{ $TCHN_LOCAT_NAME }}">{{ $TCHN_LOCAT_NAME }}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control select2" id="filterSelectLocat" style="width: 100%;" multiple>
                                <option value="">ทั้งหมด</option>
                                @foreach ($TCHN_LOCAT_NAME as $TCHN_LOCAT_NAME)
                                    @if ($TCHN_LOCAT_NAME == Auth::user()->deptName)
                                        <option value="{{ $TCHN_LOCAT_NAME }}" selected>{{ $TCHN_LOCAT_NAME }}</option>
                                    @else
                                        <option value="{{ $TCHN_LOCAT_NAME }}">{{ $TCHN_LOCAT_NAME }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>สถานะ</label>
                        <select class="form-control select2" id="filterSelectStatus" style="width: 100%;" multiple>
                            <option value="">ทั้งหมด</option>
                            @foreach ($EQUP_STS_DESC as $EQUP_STS_DESC)
                                <option value="{{ $EQUP_STS_DESC }}">{{ $EQUP_STS_DESC }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4" id="newButtonContainer" wire:ignore>
                <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
            </div>
        </div>
        <div class="card-body">
            <table id='dataTable' class="table table-bordered table-hover table-sm" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="text-align: center;">เลขครุภัณฑ์</th>
                        <th style="text-align: center;">ชื่อครุภัณฑ์</th>
                        <th style="text-align: center;">ราคา(บาท)</th>
                        <th style="text-align: center;">แผนก</th>
                        <th style="text-align: center;">วันที่นำเข้า</th>
                        <th style="text-align: center; white-space: nowrap;">อายุการใช้งาน</th>
                        <th style="text-align: center;">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($querys as $query)
                        <tr>
                            <td style="white-space: nowrap; text-align: center;">{{ $query->EQUP_ID }}</td>
                            <td style="text-align: center;">{{ $query->EQUP_NAME }}</td>
                            <td style="text-align: center;"> {{ number_format(round($query->EQUP_PRICE, 2), 2) }}</td>
                            <td style="text-align: center;">{{ $query->TCHN_LOCAT_NAME ?? '-' }}</td>
                            <td style="text-align: center;">{{ $query->EQUP_REGS_DATE }}</td>
                            <td style="text-align: center;">{{ $query->age }} ปี</td>
                            <td style="text-align: center;">
                                @if ($query->EQUP_STS_DESC == 'ใช้งาน')
                                    <span class="badge bg-success">ใช้งาน</span>
                                @elseif ($query->EQUP_STS_DESC == 'ยกเลิกการใช้')
                                    <span class="badge bg-danger">ยกเลิกการใช้</span>
                                @elseif ($query->EQUP_STS_DESC == 'จำหน่าย')
                                    <span class="badge bg-primary">จำหน่าย</span>
                                @elseif ($query->EQUP_STS_DESC == 'ห้ามใช้งาน (รอตรวจสอบ)')
                                    <span class="badge bg-dark">ห้ามใช้งาน (รอตรวจสอบ)</span>
                                @elseif ($query->EQUP_STS_DESC == 'ถูกเรียกคืน (Recall)')
                                    <span class="badge bg-secondary">ถูกเรียกคืน (Recall)</span>
                                @elseif ($query->EQUP_STS_DESC == 'เสีย')
                                    <span class="badge bg-danger">เสีย</span>
                                @elseif ($query->EQUP_STS_DESC == 'หมดอายุ')
                                    <span class="badge bg-danger">หมดอายุ</span>
                                @elseif ($query->EQUP_STS_DESC == 'ส่งซ่อม')
                                    <span class="badge bg-warning">ส่งซ่อม</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
                scrollY: '65vh',
                order: [],
                lengthMenu: [
                    [20, 30, 50, -1],
                    ['20', '30', '50', 'ทั้งหมด']
                ],
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel', // เพิ่ม HTML สำหรับไอคอน
                    filename: 'รายงานครุภัณฑ์',
                    title: `รายงานครุภัณฑ์ หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        format: {
                            body: function(data, row, column, node) {
                                if (column == 0) {
                                    return row + 1;
                                }
                                return data.replace(/<\/?span[^>]*>/g, "");
                            }
                        },
                        columns: [0, 1, 2, 3, 4, 5, 6] // ไม่ส่งออกคอลัมน์ "action"
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

        $(".select2").select2();
        $('#filterSelectID').on('select2:select select2:unselect', function(e) {
            var selectedValues = $('#filterSelectID').val();

            var sanitizedValues = selectedValues.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            if (sanitizedValues !== "") {
                table.column(0).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();
            }
            if (sanitizedValues == "") {
                table.column(0).search("").draw();
            }

        });
        $('#filterSelectName').on('select2:select select2:unselect', function(e) {
            var selectedValues = $('#filterSelectName').val();

            var sanitizedValues = selectedValues.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            if (sanitizedValues !== "") {
                table.column(1).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();
            }
            if (sanitizedValues == "") {
                table.column(1).search("").draw();
            }

        });

        $('#filterSelectLocat').on('select2:select select2:unselect', function(e) {
            // รับข้อมูลที่ถูกเลือกจาก dropdown
            var selectedValues = $('#filterSelectLocat').val();

            var sanitizedValues = selectedValues.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });


            if (sanitizedValues !== "") {
                table.column(3).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();

            }
            if (sanitizedValues == "") {
                table.column(3).search("").draw();

            }


        });


        $('#filterSelectStatus').on('select2:select select2:unselect', function(e) {
            // รับข้อมูลที่ถูกเลือกจาก dropdown
            var selectedValues = $('#filterSelectStatus').val();

            var sanitizedValues = selectedValues.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            // ตรวจสอบว่ามีการเลือกข้อมูลหรือไม่

            if (sanitizedValues !== "") {
                table.column(6).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();

            }
            if (sanitizedValues == "") {
                table.column(6).search("").draw();
            }

        });
    </script>

</div>
