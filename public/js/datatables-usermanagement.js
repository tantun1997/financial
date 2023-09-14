function initializeDataTable() {
    var table = $("#datatablesUserManagement").DataTable({
        autoWidth: true,
        responsive: true,
        ordering: true,
        order: [
            [4, "asc"],
            [5, "asc"],
            [0, "asc"],
            [1, "asc"],
            [2, "asc"],
        ],
        searching: true,
        columnDefs: [
            {
                searchable: true,
                targets: [0, 1, 2],
            },
        ],
        lengthMenu: [
            [-1, 20, 50,100],
            ["ทั้งหมด", "20", "50", "100"],
        ],
        pageLength: 20,
        language: {
            sProcessing: "กำลังดำเนินการ...",
            sLengthMenu: "แสดง _MENU_ รายการ",
            sZeroRecords: "ไม่พบข้อมูลในตาราง",
            sEmptyTable: "ไม่มีข้อมูลในตาราง",
            sInfo: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            sInfoEmpty: "แสดง 0 ถึง 0 จาก 0 รายการ",
            sInfoFiltered: "(กรองข้อมูลทั้งหมด _MAX_ รายการ)",
            sSearch: "ค้นหา:",
            sInfoThousands: ",",
            sLoadingRecords: "กำลังโหลด...",
            oPaginate: {
                sFirst: "หน้าแรก",
                sLast: "หน้าสุดท้าย",
                sNext: "ถัดไป",
                sPrevious: "ก่อนหน้า",
            },
        },
    });

    // $("#LengthMenu").on("change", function () {
    //     var length = $(this).val();
    //     table.page.len(length).draw();
    // });
    // $("#SearchMenu").on("keyup", function () {
    //     table.search(this.value).draw();
    //     console.log(this.value);
    // });
}

initializeDataTable();
