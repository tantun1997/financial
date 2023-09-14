<div class="container-fluid px-4">
    @include('layouts.loading')


    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> บันทึกแผนฯบำรุงรักษา</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a
                href="\">แผนการจัดซื้อจัดจ้าง วัสดุ/ครุภัณฑ์</a></li>
        <li class="breadcrumb-item active">
                บันทึกแผนฯบำรุงรักษา</li>
    </ol>
    <hr>
    <div class="mb-3">
        @include('layouts.maintenance.addDetail')
        @include('layouts.maintenance.edit')
        @include('layouts.maintenance.create')

    </div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            @include('layouts.maintenance.search')

            <div class="mt-4" id="newButtonContainer" wire:ignore>
                <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
            </div>
        </div>
        <div class="card-body">
            <div wire:ignore.self>
                <table id='dataTable' class="table table-bordered table-hover table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center table-cell"></th>
                            <th class="text-center table-cell" style="display: none;">รหัส</th>
                            <th class="text-center table-cell">ปี</th>
                            <th class="text-center table-cell" style="display: none;">ความสำคัญ</th>
                            <th class="text-center table-cell">แผนฯ</th>
                            <th class="text-center table-cell">ประเภท</th>
                            <th class="text-left table-cell">รายละเอียด</th>
                            <th class="text-center table-cell">ราคาต่อหน่วย</th>
                            <th class="text-center table-cell">จำนวน</th>
                            <th class="text-center table-cell">รวมทั้งหมด</th>
                            <th class="text-left table-cell">เหตุผลและความจำเป็น</th>
                            <th class="text-left table-cell">หน่วยงานที่เบิก</th>
                            <th class="text-left table-cell">หมายเหตุ</th>
                            <th class="text-center table-cell" style="display: none;">วันที่ปรับปรุงข้อมูล</th>
                            <th class="text-center table-cell">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($VW_NEW_MAINPLAN as $query)
                            @if (
                                $query->enable == 1 && $query->procurementType == 1 &&
                                    ($query->TCHN_LOCAT_ID == Auth::user()->deptId || Auth::user()->isAdmin == 'Y'))
                                <tr style="cursor: pointer;">
                                    @if ($query->levelNo != 2)
                                        <td class="table-cell">
                                            <button type="button" wire:click.prevent="add_detail({{ $query->id }})"
                                                class="btn btn-outline-success btn-sm position-relative"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                                + ครุภัณฑ์
                                                @if ($vwCountDetail->where('PROC_ID', $query->id)->count() > 0)
                                                    @foreach ($vwCountDetail->where('PROC_ID', $query->id) as $item)
                                                        <span class="badge rounded-pill bg-danger">
                                                            {{ $item->count_detail }}
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </button>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td class="table-cell" style="display: none;">{{ $query->id }}</td>
                                    <td class="table-cell">{{ $query->budget }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->priorityNo }}</td>
                                    <td class="table-cell text-center">
                                        @if ($query->levelNo == 1)
                                            <span class="badge bg-success">จริง</span>
                                        @elseif($query->levelNo == 2)
                                            <span class="badge bg-secondary">สำรอง</span>
                                        @endif
                                    </td>
                                    <td class="table-cell">{{ $query->objectName }}</td>
                                    <td class="table-cell">{{ $query->description }}</td>
                                    <td class="table-cell" style="text-align: right;">
                                        {{ number_format($query->price) }}
                                    </td>
                                    <td class="table-cell" style="text-align: right;">{{ $query->quant }}
                                        {{ $query->package }}</td>
                                    <td class="table-cell" style="text-align: right;">
                                        {{ number_format($query->price * $query->quant) }}</td>

                                    <td class="table-cell">{{ $query->reason }}</td>
                                    <td class="table-cell ">{{ $query->TCHN_LOCAT_NAME }}</td>
                                    <td class="table-cell">{{ $query->remark }}</td>
                                    <td class="table-cell" style="display: none;">{{ $query->updated_at }} </td>
                                    <td class="table-cell">
                                        <button type="button" wire:click.prevent="edit({{ $query->id }})"
                                            class="btn btn-outline-info btn-sm " data-bs-toggle="modal"
                                            data-bs-target="#exampleModal1">
                                            แก้ไข
                                        </button>
                                        <button type="button" wire:click.prevent="deletePost({{ $query->id }})"
                                            class="btn btn-outline-danger btn-sm">ลบ</button>
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
            max-width: 250px;
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
                "rowCallback": function(row, data) {
                    var columnIndexToExclude = [0, 14];

                    $(row).on('click', 'td', function(e) {
                        if (!columnIndexToExclude.includes($(this).index())) {
                            var rowData = table.row($(this).closest('tr')).data();
                            $('#myModal').modal('show');

                            $('#modalContent').html(
                                '<table class="table">' +
                                '<tr><td>ปี</td><td class="text-primary">' + rowData[2] +
                                '</td></tr>' +
                                '<tr><td>ลำดับความสำคัญ</td><td class="text-primary">' + rowData[
                                    3] + '</td></tr>' +
                                '<tr><td>แผนฯ</td><td class="text-success">' + rowData[4] +
                                '</td></tr>' +
                                '<tr><td>ประเภท</td><td class="text-primary">' + rowData[5] +
                                '</td></tr>' +
                                '<tr><td>รายการ</td><td class="text-primary">' + rowData[6] +
                                '</td></tr>' +
                                '<tr><td>ราคาต่อหน่วย</td><td class="text-primary">' + rowData[7] +
                                ' บาท</td></tr>' +
                                '<tr><td>จำนวน</td><td class="text-primary">' + rowData[8] +
                                '</td></tr>' +
                                '<tr><td>รวมทั้งหมด</td><td class="text-primary">' + rowData[9] +
                                ' บาท</td></tr>' +
                                '<tr><td>เหตุผลและความจำเป็น</td><td class="text-primary">' +
                                rowData[10] + '</td></tr>' +
                                '<tr><td>หน่วยงานที่เบิก</td><td class="text-success">' + rowData[
                                    11] + '</td></tr>' +
                                '<tr><td>หมายเหตุ</td><td class="text-danger">' + rowData[12] +
                                '</td></tr>' +
                                '<tr><td>วันที่ปรับปรุงข้อมูล</td><td class="text-secondary">' +
                                rowData[13] + '</td></tr>' +
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
                ordering: true,
                lengthMenu: [
                    [-1, 20, 30, 50],
                    ['ทั้งหมด', '20', '30', '50']
                ],

                //   dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯบำรุงรักษา',
                    title: `รายงานแผนบำรุงรักษา หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] // ไม่ส่งออกคอลัมน์ "action"
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
            table.column(2).search("").draw();

            $("#filterSelectdeptId").val("").trigger("change");
            table.column(11).search("").draw();

            $("#filterSelectobjectTypeId").val("").trigger("change");
            table.column(5).search("").draw();

        });
        $("#filterSelectyear").on("change", function() {
            var selectedValue = $(this).val();

            if (selectedValue !== "") {
                table.column(2).search("^" + selectedValue + "$", true, false).draw();

            } else {
                table.column(2).search("").draw();

            }
        });

        $("#filterSelectobjectTypeId").on("change", function() {
            var selectedValue = $(this).val();
            var escapedValue = selectedValue.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'); // Escape special characters

            if (selectedValue !== "") {
                table.column(5).search("^" + escapedValue + "$", true, false).draw();
            } else {
                table.column(5).search("").draw();
            }
        });

        $("#filterSelectdeptId").on("change", function() {
            var selectedValue = $(this).val();

            if (selectedValue !== "") {
                table.column(11).search("^" + selectedValue + "$", true, false).draw();

            } else {
                table.column(11).search("").draw();

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
