<div class="container-fluid px-4">
    @include('layouts.loading')
    <h3 class="mt-3 mb-3"><i class="fa-duotone fa-newspaper"></i> ข้อมูลแผนฯบำรุงรักษา</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a
                href="\">แผนการจัดซื้อจัดจ้าง วัสดุ/ครุภัณฑ์</a></li>
        <li class="breadcrumb-item active">
                ข้อมูลแผนฯบำรุงรักษา</li>
    </ol>
    <hr>
    <div class="mb-3">
        @foreach ($close_plan as $item)
            @if (Auth::user()->id == '114000041')
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" wire:click='close_plan'
                        @if ($item->status == 'off') checked @endif>
                    <label class="form-check-label" for="flexSwitchCheckDefault">ปิดการเพิ่มแผนฯ</label>
                </div>
            @endif

            @if ($item->status == 'on')
                <a class="btn btn-outline-primary" href="{{ route('creat_maintenance') }}"
                    role="button">สร้างแผนฯบำรุงรักษา</a>
            @endif
        @endforeach
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            @if (Auth::user()->isAdmin == 'Y')
                @include('livewire.maintenance.search')
            @else
                <div id="newButtonContainer" style="float: right;" wire:ignore>
                    <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
                </div>
            @endif
        </div>
        <div class="card-body">
            <div>
                <table id='dataTable' class="table table-bordered table-hover table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">อนุมัติแผนฯ</th> <!-- 0 -->
                            <th class="text-center">แผนฯ</th><!-- 1 -->
                            <th class="text-center" style="display: none;">รหัส</th><!-- 2 -->
                            <th class="text-center" style="display: none;">ปี</th><!-- 3 -->
                            <th class="text-center" style="display: none;">ความสำคัญ</th><!-- 4 -->
                            <th class="text-center" style="display: none;">ประเภท</th><!-- 5 -->
                            <th class="text-left" style="width: 50%;">ชื่อรายการ</th><!-- 6 -->
                            <th class="text-center">ราคาต่อหน่วย(บาท)</th><!-- 7 -->
                            <th class="text-center">จำนวน(หน่วย)</th><!-- 8 -->
                            <th class="text-center" style="display: none;">หน่วยนับ</th><!-- 9 -->
                            <th class="text-center">วงเงินรวม(บาท)</th><!-- 10 -->
                            <th class="text-left" style="display: none;">เหตุผลและความจำเป็น</th><!-- 11 -->
                            <th class="text-left">หน่วยงานที่เบิก</th><!-- 12 -->
                            <th class="text-left" style="display: none;">หมายเหตุ</th><!-- 13 -->
                            <th class="text-center" style="display: none;">วันที่ปรับปรุงข้อมูล</th>
                            <!-- 14 -->
                            <th class="text-center">จัดการ</th><!-- 15 -->
                            <th class="text-center" style="display: none;">Print out</th><!-- 16 -->
                            <th class="text-center" style="display: none;">จำนวน</th><!-- 17 -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($VW_NEW_MAINPLAN as $query)
                            @if ($query->TCHN_LOCAT_ID == Auth::user()->deptId || Auth::user()->isAdmin == 'Y')
                                <tr>
                                    <td class="table-cell text-center">
                                        @if (Auth::user()->id == '114000041')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="approvalSwitch({{ $query->id }})"
                                                    aria-labelledby="approvalSwitch({{ $query->id }})"
                                                    wire:click.prevent="Approval({{ $query->id }})"
                                                    @if ($query->approved == '1') checked @endif>
                                                <span class="form-check-label" id="approvalSwitch({{ $query->id }})">
                                                    @if ($query->approved == '1')
                                                        <span class="badge bg-success">อนุมัติแล้ว</span>
                                                    @else
                                                        <span class="badge bg-secondary">รอตรวจสอบ</span>
                                                    @endif
                                                </span>
                                            </div>
                                        @else
                                            @if ($query->approved == '1')
                                                <span class="badge bg-success">อนุมัติแล้ว</span>
                                            @else
                                                <span class="badge bg-secondary">รอตรวจสอบ</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td class="table-cell text-center">
                                        @if ($query->levelNo == 1)
                                            <span class="badge bg-success">จริง</span>
                                        @elseif($query->levelNo == 2)
                                            <span class="badge bg-secondary">สำรอง</span>
                                        @endif
                                    </td>
                                    <td class="table-cell" style="display: none;">{{ $query->id }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->budget }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->priorityNo }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->objectName }}</td>
                                    <td class="table-cell">{{ $query->description }}</td>
                                    <td class="table-cell" style="text-align: right;">
                                        {{ number_format(round($query->price, 2), 2) }}
                                    </td>
                                    <td class="table-cell" style="text-align: right;">
                                        @php
                                            $filteredItems = $vwCountDetail->where('PROC_ID', $query->id);
                                        @endphp
                                        @if ($filteredItems->count() > 0 && $query->levelNo == 1)
                                            @foreach ($vwCountDetail->where('PROC_ID', $query->id) as $item)
                                                <span style="color: #53a9fa">
                                                    {{ $item->count_detail }}
                                                </span>
                                            @endforeach / {{ $query->quant }}
                                            {{ $query->package }}
                                        @else
                                            {{ $query->quant }}
                                            {{ $query->package }}
                                        @endif
                                    </td>

                                    <td class="table-cell" style="display: none;">{{ $query->package }}</td>

                                    <td class="table-cell" style="text-align: right;">
                                        {{ number_format(round($query->price * $query->quant, 2), 2) }}

                                    <td class="table-cell" style="display: none;">{{ $query->reason }}</td>
                                    <td class="table-cell ">{{ $query->TCHN_LOCAT_NAME }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->remark }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->updated_at }} </td>
                                    <td class="table-cell" style="text-align: right;">
                                        <a class="btn btn-outline-primary btn-sm"
                                            href="{{ route('detail_maintenance', ['id' => $query->id]) }}">ดูข้อมูล</a>

                                        <button type="button" wire:click.prevent="deletePost({{ $query->id }})"
                                            class="btn btn-outline-danger btn-sm">ลบ</button>
                                    </td>
                                    <td class="table-cell" style="display: none;">
                                        @if ($query->approved == '1')
                                            <button onclick="generatePdf({{ $query->id }})"
                                                class="btn btn-danger btn-sm"><i
                                                    class="fa-duotone fa-file-pdf fa-lg"></i> PDF</button>
                                        @else
                                            <span class="badge rounded-pill bg-secondary">
                                                ไม่สามารถปริ้นได้
                                            </span>
                                        @endif
                                    </td>
                                    <td class="table-cell" style="display: none;">
                                        {{ $query->quant }}</td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .table-cell {
            white-space: nowrap;
            max-width: 200px;
            /* ปรับขนาดตามที่ต้องการ */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #000000;
        }
    </style>

    <script>
        function generatePdf(id) {
            // window.location.href = '/generatePdf/' + id;
            window.open('/generatePdf/' + id, '_blank');

        }

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
                scrollX: true,
                scrollY: '65vh',
                scrollCollapse: true,
                ordering: true,
                order: [],
                lengthMenu: [
                    [-1, 20, 30, 50],
                    ['ทั้งหมด', '20', '30', '50']
                ],

                //   dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯบำรุงรักษา',
                    title: `รายงานแผนฯบำรุงรักษา หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [0, 1, 3, 4, 5, 6, 7, 17, 9, 10, 11, 12, 13, 14]
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

        $('#resetBtn').click(function() {
            $("#filterSelectyear").val("").trigger("change");
            table.column(4).search("").draw();

            $("#filterSelectdeptId").val("").trigger("change");
            table.column(13).search("").draw();

            $("#filterSelectobjectTypeId").val("").trigger("change");
            table.column(6).search("").draw();

        });
        $("#filterSelectyear").on("change", function() {
            var selectedValue = $(this).val();

            if (selectedValue !== "") {
                table.column(4).search("^" + selectedValue + "$", true, false).draw();

            } else {
                table.column(4).search("").draw();

            }
        });

        $("#filterSelectobjectTypeId").on("change", function() {
            var selectedValue = $(this).val();
            var escapedValue = selectedValue.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); // Escape special characters

            if (selectedValue !== "") {
                table.column(6).search("^" + escapedValue + "$", true, false).draw();
            } else {
                table.column(6).search("").draw();
            }
        });

        $("#filterSelectdeptId").on("change", function() {
            var selectedValue = $(this).val();
            var escapedValue = selectedValue.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); // Escape special characters

            if (selectedValue !== "") {
                table.column(13).search("^" + escapedValue + "$", true, false).draw();
            } else {
                table.column(13).search("").draw();
            }
        });

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

        window.addEventListener('swal:error', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                urls: event.detail.urls,
                timer: 3000,
            }).then(function() {
                window.location.href = event.detail.urls;
            });
        });
    </script>

</div>
