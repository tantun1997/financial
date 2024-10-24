<div class="container-fluid">
    <h3 class="mt-3 mb-3">
        <div class="card-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                style="fill: rgb(44, 245, 121);">
                <path
                    d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z">
                </path>
                <path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z">
                </path>
                <path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z">
                </path>
            </svg> ข้อมูลแผนสอบเทียบเครื่องมือ
    </h3>

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
                <a class="btn btn-outline-primary" href="{{ route('creat_calibration') }}" role="button">+
                    เพิ่มแผนสอบเทียบเครื่องมือ</a>
            @endif
        @endforeach
    </div>
    <div id="newButtonContainer" style="float: right;" wire:ignore>
        <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
    </div>
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <button class="nav-link active" id="Plan_ID-tab" data-bs-toggle="tab" data-bs-target="#Plan_ID"
                type="button" aria-controls="Plan_ID" aria-selected="true">ค้นหาเลขที่แผน</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="Plan_NAME-tab" data-bs-toggle="tab" data-bs-target="#Plan_NAME" type="button"
                aria-controls="Plan_NAME" aria-selected="false">ค้นหาชื่อแผน</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="TCHN_LOCAT_NAME-tab" data-bs-toggle="tab" data-bs-target="#TCHN_LOCAT_NAME"
                type="button" aria-controls="TCHN_LOCAT_NAME" aria-selected="false">ค้นหาหน่วยงาน</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button"
                aria-controls="approved" aria-selected="false">รายการอนุมัติ</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Plan_ID" aria-labelledby="Plan_ID-tab">
            <div class="row mt-3">
                <div class="col-md-4">
                    <select class="form-control select2" id="filterSelectID" style="width: 100%;" multiple>
                        {{-- <option value="" selected>ทั้งหมด</option> --}}
                        @foreach ($Plan_ID as $id)
                            <option value="{{ $id }}">{{ $id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="Plan_NAME" aria-labelledby="Plan_NAME-tab">
            <div class="row mt-3">
                <div class="col-md-4">
                    <select class="form-control select2" id="filterSelectName" style="width: 100%;" multiple>
                        {{-- <option value="" selected>ทั้งหมด</option> --}}
                        @foreach ($Plan_NAME as $names)
                            <option value="{{ $names }}">{{ $names }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="TCHN_LOCAT_NAME" aria-labelledby="TCHN_LOCAT_NAME-tab">
            <div class="row mt-3">
                <div class="col-md-4">
                    <select class="form-control select2" id="filterSelectTCHN" style="width: 100%;" multiple>
                        {{-- <option value="" selected>ทั้งหมด</option> --}}
                        @foreach ($TCHN_LOCAT_NAME as $names)
                            <option value="{{ $names }}">{{ $names }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="approved" aria-labelledby="approved-tab">
            <div class="row mt-3">
                <div class="col-md-4">
                    <select class="form-control select2" id="filterSelectApproved" style="width: 100%;" multiple>
                        <option value="รออนุมัติ">รออนุมัติ</option>
                        <option value="อนุมัติแล้ว">อนุมัติแล้ว</option>
                        <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>

                    </select>

                </div>
            </div>
        </div>
    </div>
    <br>

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
                        <th style="display: none;">ราคาต่อหน่วย</th>
                        <th style="display: none;">จำนวน</th>

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
                                        <br><span style="color: red">ใช้ไปแล้ว:
                                            {{ number_format(round($item->Total_Current_Price, 2), 2) }} บาท
                                        </span>
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
                                    href="http://192.168.2.142/calibration/detail?id={{ $item->Plan_ID }}">ดูข้อมูล</a>
                                <button type="button" wire:click.prevent="deletePost({{ $item->Plan_ID }})"
                                    class="btn btn-outline-danger btn-sm">ลบ</button>
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
                                            {{-- <span class="badge bg-warning text-dark">รออนุมัติ</span><br> --}}
                                            <button type="button"
                                                wire:click="requset_approved({{ $item->Plan_ID }})"
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
                            <td style="display: none;">{{ number_format(round($item->Total_Current_Price, 2), 2) }}
                            </td>
                            <td style="display: none;">{{ number_format(round($item->Remaining_Price, 2), 2) }}</td>
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
                            <td style="display: none">
                                {{ number_format(round($item->Plan_PRICE_OVERALL, 2), 2) }}
                            </td>
                            <td style="display: none">
                                {{ $item->Plan_AMOUNT }}
                            </td>
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
                order: [],
                autoWidth: true,
                searching: true,
                responsive: true,
                // scrollX: true,
                // scrollY: '65vh',
                // scrollCollapse: true,
                ordering: true,
                lengthMenu: [
                    [-1, 10, 50, 100],
                    ['ทั้งหมด', '10', '50', '100']
                ],
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i> Export to Excel',
                    filename: 'บันทึกแผนฯสอบเทียบเครื่องมือ',
                    title: `รายงานแผนฯสอบเทียบเครื่องมือ หน่วยบริการโรงพยาบาลสมเด็จพระพุทธเลิศหล้า`,
                    autoFilter: true,
                    exportOptions: {
                        columns: [5, 6, 7, 17, 8, 9, 18, 19, 10, 11, 12, 13, 14, 15, 16]
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
        $("#Plan_ID-tab").on("click", function() {
            // ลบค่าที่เลือกใน Select2
            $('#filterSelectID').val(null);
            $('#filterSelectName').val(null);

            // ค้นหาข้อมูลใหม่ในตาราง
            table.search('').columns().search('').draw();
        });

        $("#Plan_NAME-tab").on("click", function() {
            // ลบค่าที่เลือกใน Select2
            $('#filterSelectID').val(null);
            $('#filterSelectName').val(null);

            // ค้นหาข้อมูลใหม่ในตาราง
            table.search('').columns().search('').draw();
        });
        $("#TCHN_LOCAT_NAME-tab").on("click", function() {
            // ลบค่าที่เลือกใน Select2

            $('#filterSelectID').val(null);
            $('#filterSelectName').val(null);
            $('#filterSelectTCHN').val(null);
            // ค้นหาข้อมูลใหม่ในตาราง
            table.search('').columns().search('').draw();
        });
        $("#approved-tab").on("click", function() {
            // ลบค่าที่เลือกใน Select2
            $('#filterSelectID').val(null);
            $('#filterSelectName').val(null);
            $('#filterSelectTCHN').val(null);
            // ค้นหาข้อมูลใหม่ในตาราง
            table.search('').columns().search('').draw();
        });
        $(".select2").select2();
        $('#filterSelectID').on('select2:select select2:unselect', function(e) {
            var values = $('#filterSelectID').val();
            // console.log(values);
            var sanitizedValues = values.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            if (sanitizedValues) {
                table.column(5).search(sanitizedValues.join('|'), true, false).draw();

            } else {
                table.column(5).search('').draw();
            }
        });
        $('#filterSelectName').on('select2:select select2:unselect', function(e) {
            var values = $('#filterSelectName').val();
            // console.log(values);
            var sanitizedValues = values.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            if (sanitizedValues) {
                table.column(6).search(sanitizedValues.join('|'), true, false).draw();

            } else {
                table.column(6).search('').draw();
            }
        });
        $('#filterSelectTCHN').on('select2:select select2:unselect', function(e) {
            var values = $('#filterSelectTCHN').val();
            // console.log(values);
            var sanitizedValues = values.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            if (sanitizedValues) {
                table.column(12).search(sanitizedValues.join('|'), true, false).draw();

            } else {
                table.column(12).search('').draw();
            }
        });
        $('#filterSelectApproved').on('select2:select select2:unselect', function(e) {
            var values = $('#filterSelectApproved').val();
            // console.log(values);
            var sanitizedValues = values.map(function(value) {
                return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            });

            if (sanitizedValues) {
                table.column(16).search(sanitizedValues.join('|'), true, false).draw();

            } else {
                table.column(16).search('').draw();
            }
        });
    </script>


</div>
