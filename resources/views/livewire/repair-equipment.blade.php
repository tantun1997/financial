<div class="container-fluid px-4">
    @include('layouts.loading')


    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> บันทึกแผนฯซ่อม</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a
                href="\">แผนการจัดซื้อจัดจ้าง วัสดุ/ครุภัณฑ์</a></li>
        <li class="breadcrumb-item active">
                บันทึกแผนฯซ่อม</li>
    </ol>
    <hr>
    <div class="mb-3">
        @include('layouts.repair.addDetail')
        @include('layouts.repair.edit')
        @include('layouts.repair.create')

    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            @if (Auth::user()->isAdmin == 'Y')
                @include('layouts.repair.search')
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
                            <th class="text-center">ครุภัณฑ์</th><!-- 2 -->
                            <th class="text-center" style="display: none;">รหัส</th><!-- 3 -->
                            <th class="text-center" style="display: none;">ปี</th><!-- 4 -->
                            <th class="text-center" style="display: none;">ความสำคัญ</th><!-- 5 -->
                            <th class="text-center" style="display: none;">ประเภท</th><!-- 6 -->
                            <th class="text-left" style="width: 50%;">ชื่อรายการ</th><!-- 7 -->
                            <th class="text-center">ราคาต่อหน่วย(บาท)</th><!-- 8 -->
                            <th class="text-center">จำนวน(หน่วย)</th><!-- 9 -->
                            <th class="text-center" style="display: none;">หน่วยนับ</th><!-- 10 -->
                            <th class="text-center">วงเงินรวม(บาท)</th><!-- 11 -->
                            <th class="text-left" style="display: none;">เหตุผลและความจำเป็น</th><!-- 12 -->
                            <th class="text-left">หน่วยงานที่เบิก</th><!-- 13 -->
                            <th class="text-left" style="display: none;">หมายเหตุ</th><!-- 14 -->
                            <th class="text-center" style="display: none;">วันที่ปรับปรุงข้อมูล</th>
                            <!-- 15 -->
                            <th class="text-center">action</th><!-- 16 -->
                            <th class="text-center" style="display: none;">Print out</th><!-- 17 -->
                            <th class="text-center" style="display: none;">Count</th><!-- 18 -->
                            <th class="text-center" style="display: none;">จำนวน</th><!-- 19 -->

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($VW_NEW_MAINPLAN as $query)
                            @if ($query->TCHN_LOCAT_ID == Auth::user()->deptId || Auth::user()->isAdmin == 'Y')
                                <tr style="cursor: pointer;">
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
                                    @if ($query->levelNo != 2)
                                        <td class="table-cell">
                                            @php
                                                $filteredItems = $vwCountDetail->where('PROC_ID', $query->id);
                                            @endphp
                                            @if ($filteredItems->count() > 0)
                                                <button type="button"
                                                    wire:click.prevent="add_detail({{ $query->id }})"
                                                    class="btn btn-outline-success btn-sm position-relative"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                                    @foreach ($vwCountDetail->where('PROC_ID', $query->id) as $item)
                                                        <span class="badge rounded-pill bg-danger">
                                                            {{ $item->count_detail }}
                                                        </span>
                                                    @endforeach ครุภัณฑ์
                                                </button>
                                            @else
                                                <button type="button"
                                                    wire:click.prevent="add_detail({{ $query->id }})"
                                                    class="btn btn-outline-success btn-sm position-relative"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                                    + ครุภัณฑ์
                                                </button>
                                            @endif
                                        </td>
                                    @else
                                        <td></td>
                                    @endif

                                    <td class="table-cell" style="display: none;">{{ $query->id }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->budget }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->priorityNo }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->objectName }}</td>
                                    <td class="table-cell">{{ $query->description }}</td>
                                    <td class="table-cell" style="text-align: right;">
                                        {{ number_format($query->price) }}
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
                                        {{ number_format($query->price * $query->quant) }}</td>

                                    <td class="table-cell" style="display: none;">{{ $query->reason }}</td>
                                    <td class="table-cell">{{ $query->TCHN_LOCAT_NAME }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->remark }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->updated_at }} </td>
                                    <td class="table-cell" style="text-align: right;">
                                        @if ($query->approved == '1' && $query->levelNo == '1')
                                        @else
                                            <button type="button" wire:click.prevent="edit({{ $query->id }})"
                                                class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal1">
                                                แก้ไข
                                            </button>
                                        @endif

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
                                    @if (Auth::user()->id == '114000041')
                                        <td class="table-cell" style="display: none;">
                                            @php
                                                $filteredItems = $vwCountDetail->where('PROC_ID', $query->id);
                                            @endphp
                                            @foreach ($filteredItems as $item)
                                                {{ $item->count_detail }}
                                            @endforeach
                                        </td>
                                    @else
                                        <td style="display: none;"></td>
                                    @endif
                                    <td class="table-cell" style="display: none;">{{ $query->quant }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
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
                "rowCallback": function(row, data) {
                    var columnIndexToExclude = [0, 2, 16, 17, 18];

                    $(row).on('click', 'td', function(e) {
                        if (!columnIndexToExclude.includes($(this).index())) {
                            var rowData = table.row($(this).closest('tr')).data();
                            $('#myModal').modal('show');

                            $('#modalContent').html(
                                '<table class="table">' +
                                '<tr><td>ID</td><td class="text-primary">' + rowData[3] +
                                '</td></tr>' +
                                '<tr><td>ปี</td><td class="text-primary">' + rowData[4] +
                                '</td></tr>' +
                                '<tr><td>ลำดับความสำคัญ</td><td class="text-primary">' + rowData[
                                    5] + '</td></tr>' +
                                '<tr><td>แผนฯ</td><td class="text-success">' + rowData[1] +
                                '</td></tr>' +
                                '<tr><td>ประเภท</td><td class="text-primary">' + rowData[6] +
                                '</td></tr>' +
                                '<tr><td>ชื่อรายการ</td><td class="text-primary">' + rowData[7] +
                                '</td></tr>' +
                                '<tr><td>ราคาต่อหน่วย</td><td class="text-primary">' + rowData[8] +
                                ' บาท</td></tr>' +
                                '<tr><td>จำนวน</td><td class="text-primary">' + rowData[9] +
                                '</td></tr>' +
                                '<tr><td>วงเงินรวม</td><td class="text-primary">' + rowData[11] +
                                ' บาท</td></tr>' +
                                '<tr><td>เหตุผลและความจำเป็น</td><td class="text-primary">' +
                                rowData[12] + '</td></tr>' +
                                '<tr><td>หน่วยงานที่เบิก</td><td class="text-success">' + rowData[
                                    13] + '</td></tr>' +
                                '<tr><td>หมายเหตุ</td><td class="text-danger">' + rowData[14] +
                                '</td></tr>' +
                                '<tr><td>วันที่ปรับปรุงข้อมูล</td><td class="text-secondary">' +
                                rowData[15] + '</td></tr>' +
                                '<tr><td>Print Out</td><td class="text-secondary">' +
                                rowData[17] + '</td></tr>' +

                                '</table>'
                            );


                        }
                    });
                },
                order: [
                    [18, "desc"]
                ],
                autoWidth: true,
                searching: true,
                responsive: true,
                scrollX: true,
                scrollY: '65vh',
                scrollCollapse: true,
                ordering: true,
                lengthMenu: [
                    [-1, 20, 30, 50],
                    ['ทั้งหมด', '20', '30', '50']
                ],

                //   dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯซ่อม',
                    title: `รายงานแผนฯซ่อม หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [0, 1, 4, 5, 6, 7, 8, 19, 10, 11, 12, 13, 14, 15]
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
