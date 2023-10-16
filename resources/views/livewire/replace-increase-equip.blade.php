<div class="container-fluid px-4">
    @include('layouts.loading')


    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> บันทึกแผนฯทดแทน-เพิ่มศักย์ภาพ</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a
                href="\">แผนการจัดซื้อจัดจ้าง วัสดุ/ครุภัณฑ์</a></li>
        <li class="breadcrumb-item active">
                บันทึกแผนฯทดแทน-เพิ่มศักย์ภาพ</li>
    </ol>
    <hr>
    <div class="mb-3">

        @include('layouts.replaceIncreaseEquip.edit')
        @include('layouts.replaceIncreaseEquip.create')
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            {{-- @include('layouts.replaceIncreaseEquip.search') --}}

            <div id="newButtonContainer" style="float: right;" wire:ignore>
                <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
            </div>
        </div>
        <div class="card-body">
            <div>
                <table id='dataTable' class="table table-bordered table-hover table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="display: none;">id</th> <!-- 0 -->
                            <th class="text-center">อนุมัติแผนฯ</th> <!-- 1 -->
                            <th class="text-center">แผนฯ</th><!-- 2 -->
                            <th class="text-center" style="display: none;">ปี</th><!-- 3 -->
                            <th class="text-left" style="width: 50%;">ชื่อรายการครุภัณฑ์</th><!-- 4 -->
                            <th class="text-center">ราคาต่อหน่วย(บาท)</th><!-- 5 -->
                            <th class="text-center">จำนวน(หน่วย)</th><!-- 6 -->
                            <th class="text-center">วงเงินรวม(บาท)</th><!-- 7 -->
                            <th class="text-left" style="display: none;">เหตุผลและความจำเป็น</th><!-- 8 -->
                            <th class="text-left">หน่วยงานที่เบิก</th><!-- 9 -->
                            <th class="text-left" style="display: none;">หมายเหตุ</th><!-- 10 -->
                            <th class="text-left" style="display: none;">ประเภทการขอ</th><!-- 11 -->
                            <th class="text-center" style="display: none;">วันที่ปรับปรุงข้อมูล</th><!-- 12 -->
                            <th class="text-center">action</th><!-- 13 -->
                            <th class="text-center" style="display: none;">หน่วยนับ</th><!-- 14 -->
                            <th class="text-center" style="display: none;">จำนวน</th><!-- 15 -->
                            <th class="text-center" style="display: none;">Print out</th><!-- 16 -->

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($replace_increase_equip as $item)
                            @if ($item->deptId == Auth::user()->deptId || Auth::user()->isAdmin == 'Y')
                                <tr style="cursor: pointer;">
                                    <td class="table-cell" style="display: none;">{{ $item->id }}</td>
                                    <td class="table-cell text-center">
                                        @if (Auth::user()->id == '114000041')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="approvalSwitch({{ $item->id }})"
                                                    aria-labelledby="approvalSwitch({{ $item->id }})"
                                                    wire:click.prevent="Approval({{ $item->id }})"
                                                    @if ($item->approved == '1') checked @endif>
                                                <span class="form-check-label" id="approvalSwitch({{ $item->id }})">
                                                    @if ($item->approved == '1')
                                                        <span class="badge bg-success">อนุมัติแล้ว</span>
                                                    @else
                                                        <span class="badge bg-secondary">รอตรวจสอบ</span>
                                                    @endif
                                                </span>
                                            </div>
                                        @else
                                            @if ($item->approved == '1')
                                                <span class="badge bg-success">อนุมัติแล้ว</span>
                                            @else
                                                <span class="badge bg-secondary">รอตรวจสอบ</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="table-cell text-center">
                                        @if ($item->levelNo == 1)
                                            <span class="badge bg-success">จริง</span>
                                        @elseif($item->levelNo == 2)
                                            <span class="badge bg-secondary">สำรอง</span>
                                        @endif
                                    </td>
                                    <td class="table-cell" style="display: none;">{{ $item->year }}</td>
                                    <td class="table-cell" style="text-align: left;">{{ $item->description }}</td>
                                    <td class="table-cell" style="text-align: right;">{{ number_format($item->price) }}
                                    </td>
                                    <td class="table-cell" style="text-align: right;">{{ $item->qty }}
                                        {{ $item->unit }}</td>
                                    <td class="table-cell" style="text-align: right;">
                                        {{ number_format($item->price * $item->qty) }}</td>
                                    <td class="table-cell" style="display: none;">{{ $item->reason }}</td>
                                    <td class="table-cell" style="text-align: left;">{{ $item->TCHN_LOCAT_NAME }}</td>
                                    <td class="table-cell" style="display: none;">{{ $item->remark }}</td>
                                    <td class="table-cell text-center" style="display: none;">
                                        @if ($item->request_type == 1)
                                            <span>ทดแทน</span>
                                        @elseif($item->request_type == 2)
                                            <span>เพิ่มศักยภาพ</span>
                                        @endif
                                    </td>
                                    <td class="table-cell" style="display: none;">{{ $item->updated_at }}</td>
                                    <td class="table-cell" style="text-align: right;">
                                        @if ($item->approved == '1' && $item->levelNo == '1')
                                        @else
                                            <button type="button" wire:click.prevent="edit({{ $item->id }})"
                                                class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal1">
                                                แก้ไข
                                            </button>
                                        @endif
                                        <button type="button" wire:click.prevent="deletePost({{ $item->id }})"
                                            class="btn btn-outline-danger btn-sm">ลบ</button>
                                    </td>
                                    <td class="table-cell" style="display: none;"> {{ $item->unit }}</td>
                                    <td class="table-cell" style="display: none;">{{ $item->qty }}</td>
                                    <td class="table-cell" style="display: none;">
                                        @if ($item->approved == '1')
                                            <button onclick="generatePdf({{ $item->id }})"
                                                class="btn btn-danger btn-sm"><i
                                                    class="fa-duotone fa-file-pdf fa-lg"></i>
                                                PDF</button>
                                        @else
                                            <span class="badge rounded-pill bg-secondary">
                                                ไม่สามารถปริ้นได้
                                            </span>
                                        @endif
                                    </td>
                            @endif
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">รายละเอียดข้อมูล</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- แสดงข้อมูลที่คุณต้องการใน Modal ที่นี่ -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
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

        /* .dataTables_filter label {
             display: none;
         } */

        .btn {
            border-radius: 5px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }


        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <script>
        function generatePdf(id) {
            window.open('/replaceEquipPdf/' + id, '_blank');

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
                "rowCallback": function(row, data) {
                    var columnIndexToExclude = [1, 2, 13];

                    $(row).on('click', 'td', function(e) {
                        if (!columnIndexToExclude.includes($(this).index())) {
                            var rowData = table.row($(this).closest('tr')).data();
                            $('#myModal').modal('show');

                            $('#modalContent').html(
                                '<table class="table">' +
                                '<tr><td>ID</td><td class="text-primary">' + rowData[0] +
                                '</td></tr>' +
                                '<tr><td>ปี</td><td class="text-primary">' + rowData[3] +
                                '</td></tr>' +
                                '<tr><td>แผนฯ</td><td class="text-success">' + rowData[2] +
                                '</td></tr>' +
                                '<tr><td>ประเภทการขอ</td><td class="text-primary">' + rowData[11] +
                                '</td></tr>' +
                                '<tr><td>ชื่อรายการ</td><td class="text-primary">' + rowData[4] +
                                '</td></tr>' +
                                '<tr><td>ราคาต่อหน่วย</td><td class="text-primary">' + rowData[5] +
                                ' บาท</td></tr>' +
                                '<tr><td>จำนวน</td><td class="text-primary">' + rowData[6] +
                                '</td></tr>' +
                                '<tr><td>วงเงินรวม</td><td class="text-primary">' + rowData[7] +
                                ' บาท</td></tr>' +
                                '<tr><td>เหตุผลและความจำเป็น</td><td class="text-primary">' +
                                rowData[8] + '</td></tr>' +
                                '<tr><td>หน่วยงานที่เบิก</td><td class="text-success">' + rowData[
                                    9] + '</td></tr>' +
                                '<tr><td>หมายเหตุ</td><td class="text-danger">' + rowData[10] +
                                '</td></tr>' +
                                '<tr><td>วันที่ปรับปรุงข้อมูล</td><td class="text-secondary">' +
                                rowData[12] + '</td></tr>' +
                                '<tr><td>Print Out</td><td class="text-secondary">' +
                                rowData[16] + '</td></tr>' +
                                '</table>'
                            );
                        }
                    });
                },
                order: [],
                autoWidth: true,
                searching: true,
                responsive: true,
                scrollX: true,
                scrollY: '65vh',
                scrollCollapse: true,
                lengthMenu: [
                    [-1, 20, 30, 50],
                    ['ทั้งหมด', '20', '30', '50']
                ],

                //   dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯทดแทน-เพิ่มศักย์ภาพ',
                    title: `รายงานแผนฯทดแทน-เพิ่มศักย์ภาพ หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 15, 14, 7, 8, 9, 10, 11, 12]
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
