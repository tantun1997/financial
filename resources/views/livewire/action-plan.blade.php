<div class="container-fluid px-4">
    {{-- @include('layouts.loading') --}}
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> แผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. {{ $year }}</h3>
    <hr>
    <div class="mb-3">
        <a class="btn btn-outline-primary" href="{{ route('creat_action_plan', ['planType' => 'strategic']) }}"
            role="button">สร้างแผนยทุธศาสตร์</a>
        <a class="btn btn-outline-primary" href="{{ route('creat_action_plan', ['planType' => 'regular']) }}"
            role="button">สร้างแผนประจำ</a>
    </div>


    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card mb-4">
        {{-- <div class="card-header">

            <div id="newButtonContainer" style="float: right;" wire:ignore>
                <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
            </div>
        </div> --}}
        <div class="card-body">
            <div>
                <table id='dataTable' class="table table-bordered table-hover table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-left" style="width: 60%;">ชื่อรายการ</th>
                            <th class="text-left">แผนก</th>
                            <th class="text-left">ประเภทแผน</th>
                            <th class="text-center">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ACP_ProjectName_Main as $item)
                            @if ($item->dept_id == Auth::user()->deptId || Auth::user()->isAdmin == 'Y')
                                <tr>
                                    <td class="text-left table-cell">{{ $item->project_name }}</td>
                                    <td class="text-left table-cell">{{ $item->dept_name }}</td>
                                    <td class="text-left table-cell">
                                        @if ($item->planType == 'strategic')
                                            <span>แผนยุทธศาสตร์</span>
                                        @elseif($item->planType == 'regular')
                                            <span>แผนประจำ</span>
                                        @endif
                                    </td>
                                    <td class="text-center table-cell">
                                        <a class="btn btn-outline-primary btn-sm"
                                            href="{{ route('detail_action_plan', ['id' => $item->project_ID]) }}">ดูข้อมูล</a>
                                        <button type="button" wire:click="deleteRow({{ $item->project_ID }})"
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
        initializeDataTable();
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
                order: [],
                autoWidth: true,
                searching: true,
                responsive: true,
                ordering: true,
                lengthMenu: [
                    // [-1, 20, 30, 50],
                    // ['ทั้งหมด', '20', '30', '50']
                    [30, 50, 100, -1],
                    ['30', '50', '100', 'ทั้งหมด']
                ],

                //   dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯบำรุงรักษา',
                    title: `รายงานแผนฯบำรุงรักษา หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [0, 1, 2]
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
