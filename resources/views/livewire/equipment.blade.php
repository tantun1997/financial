 <div class="container-fluid px-4">
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

     <h3 class="mt-3 mb-3"><i class="fa-duotone fa-newspaper"></i> ครุภัณฑ์</h3>
     <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item "><a
                 href="\">แผนการจัดซื้อจัดจ้าง วัสดุ/ครุภัณฑ์</a></li>
            <li class="breadcrumb-item active">
                 รายงานครุภัณฑ์</li>
     </ol>
     <hr>
     <div class="card mb-4">

         <div class="card-header">
             <div class="row">
                 <div class="col-md-3">
                     <div class="form-group">
                         <label>ชื่อครุภัณฑ์</label>
                         <select class="form-control select2" id="filterSelectName" style="width: 100%;" multiple>
                             <option value="" selected>ทั้งหมด</option>
                             @foreach ($name as $names)
                                 <option value="{{ $names }}">{{ $names }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
                 <div class="col-md-3">
                     <div class="form-group">
                         <label>แผนก</label>
                         <select class="form-control select2" id="filterSelectLocat" style="width: 100%;" multiple>
                             <option value="" selected>ทั้งหมด</option>
                             <option value="-">-</option>
                             @foreach ($locat as $loc)
                                 <option value="{{ $loc }}">{{ $loc }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
                 {{-- <div class="col-md-3">
                     <div class="form-group">
                         <label>หมวดหมู่</label>
                         <select class="form-control select2" id="filterSelectCata" style="width: 100%;" multiple>
                             <option value="" selected>ทั้งหมด</option>
                             @foreach ($cata as $catas)
                                 <option value="{{ $catas }}">{{ $catas }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div> --}}
                 {{-- <div class="col-md-3">
                         <div class="form-group">
                             <label>ประเภท</label>
                             <select class="form-control select2" id="filterSelectType" style="width: 100%;" multiple>
                                 <option value="" selected>ทั้งหมด</option>
                                 <option value="-">-</option>
                                 @foreach ($type as $types)
                                     <option value="{{ $types }}">{{ $types }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div> --}}
                 {{-- <div class="col-md-3">
                         <div class="form-group">
                             <label>สถานะ</label>
                             <select class="form-control select2" id="filterSelectStatus" style="width: 100%;" multiple>
                                 <option value="" selected>ทั้งหมด</option>
                                 @foreach ($status as $statuss)
                                     <option value="{{ $statuss }}">{{ $statuss }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div> --}}
                 {{-- <div class="col-md-3 mt-4">
                         <button id="resetBtn" class="btn btn-danger">Reset</button>
                     </div> --}}
             </div>

             <div class="mt-4" id="newButtonContainer" wire:ignore>
                 <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
             </div>
         </div>
         <div class="card-body">
                 <table id='dataTable' class="nowrap cell-border table table-bordered table-hover"
                     style="width: 100%; text-align: center; border-top: 1px solid #ddd; ">
                     <thead>
                         <tr>
                             <th style="text-align: center;">No.</th>
                             <th style="text-align: center;">เลขที่</th>
                             <th style="text-align: center;">รหัส</th>
                             <th style="text-align: center;">ชื่อครุภัณฑ์</th>
                             <th style="text-align: center;">ราคา</th>
                             <th style="text-align: center;">แผนก</th>
                             <th style="text-align: center;">วันที่นำเข้า</th>
                             {{-- <th style="text-align: center;">หมวดหมู่</th> --}}
                             {{-- <th style="text-align: center;">ประเภท</th> --}}
                             <th style="text-align: center;">สถานะ</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($querys as $query)
                             <tr>
                                 <td>{{ $query->index }}</td>
                                 <td>{{ $query->EQUP_LINK_NO }}</td>
                                 <td>{{ $query->EQUP_ID }}</td>
                                 <td>{{ $query->EQUP_NAME }}</td>
                                 <td>{{ $query->EQUP_PRICE }}</td>
                                 <td>{{ $query->TCHN_LOCAT_NAME ?? '-' }}</td>
                                 <td>{{ $query->EQUP_REGS_DATE }}</td>
                                 {{-- <td>{{ $query->EQUP_CAT_NAME }}</td> --}}
                                 {{-- <td>{{ $query->EQUP_TYPE_NAME ?? '-' }}</td> --}}

                                 <td>
                                     @if ($query->EQUP_STS_DESC == 'ใช้งาน')
                                         <span class="badge bg-success">ใช้งาน</span>
                                         {{-- @elseif ($query->EQUP_STS_DESC == 'ยกเลิกการใช้')
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
                                         <span class="badge bg-warning">ส่งซ่อม</span> --}}
                                     @endif
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

         /* .dataTables_filter label {
             display: none;
         } */
     </style>

     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                 select: false,
                 searching: true,
                 responsive: true,
                 scrollX: true,
                 scrollY: '60vh',
                 scrollCollapse: true,
                 ordering: true, // เปิดใช้งานการเรียงลำดับ
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
                         columns: [0, 1, 2, 3, 4, 5, 6, 7] // ไม่ส่งออกคอลัมน์ "action"
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

         table.on('order.dt search.dt', function() {
             table.column(0, {
                 search: 'applied',
                 order: 'applied'
             }).nodes().each(function(cell, i) {
                 cell.innerHTML = i + 1;
             });
         }).draw();

         //  $('#resetBtn').click(function() {
         //      $('#filterSelectName').val("").trigger("change.select2");
         //      table.column(3).search("").draw();

         //      $("#filterSelectLocat").val("").trigger("change.select2");
         //      table.column(6).search("").draw();

         //      $("#filterSelectCata").val("").trigger("change.select2");
         //      table.column(7).search("").draw();

         //      $("#filterSelectType").val("").trigger("change.select2");
         //      table.column(8).search("").draw();

         //      $("#filterSelectStatus").val("").trigger("change.select2");
         //      table.column(9).search("").draw();

         //  });

         $(".select2").select2();
         $('#filterSelectName').on('select2:select select2:unselect', function(e) {
             var selectedValues = $('#filterSelectName').val();

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

         $('#filterSelectLocat').on('select2:select select2:unselect', function(e) {
             // รับข้อมูลที่ถูกเลือกจาก dropdown
             var selectedValues = $('#filterSelectLocat').val();

             var sanitizedValues = selectedValues.map(function(value) {
                 return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
             });


             if (sanitizedValues !== "") {
                 table.column(5).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();

             }
             if (sanitizedValues == "") {
                 table.column(5).search("").draw();

             }
             var containsDash = sanitizedValues.includes('-');

             if (containsDash) {
                 table.column(5).search('^\\-', true, true).draw();
             }

         });

         $('#filterSelectCata').on('select2:select select2:unselect', function(e) {
             // รับข้อมูลที่ถูกเลือกจาก dropdown
             var selectedValues = $('#filterSelectCata').val();

             var sanitizedValues = selectedValues.map(function(value) {
                 return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
             });

             // ตรวจสอบว่ามีการเลือกข้อมูลหรือไม่

             if (sanitizedValues !== "") {
                 table.column(7).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();

             }
             if (sanitizedValues == "") {
                 table.column(7).search("").draw();
             }

         });

         $('#filterSelectType').on('select2:select select2:unselect', function(e) {
             // รับข้อมูลที่ถูกเลือกจาก dropdown
             var selectedValues = $('#filterSelectType').val();

             var sanitizedValues = selectedValues.map(function(value) {
                 return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
             });


             if (sanitizedValues !== "") {
                 table.column(8).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();

             }
             if (sanitizedValues == "") {
                 table.column(8).search("").draw();

             }
             var containsDash = sanitizedValues.includes('-');

             if (containsDash) {
                 table.column(8).search('^\\-', true, true).draw();
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
                 table.column(9).search("^(" + sanitizedValues.join("|") + ")$", true, false).draw();

             }
             if (sanitizedValues == "") {
                 table.column(9).search("").draw();
             }

         });
     </script>

 </div>
