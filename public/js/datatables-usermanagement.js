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
        bLengthChange: false,
        searching: true,
        columnDefs: [
            {
                searchable: true,
                targets: [0, 1, 2],
            },
        ],
        dom: "lrtip",
    });

    $("#LengthMenu").on("change", function () {
        var length = $(this).val();
        table.page.len(length).draw();
    });
    $("#SearchMenu").on("keyup", function () {
        table.search(this.value).draw();
        console.log(this.value);
    });
}

initializeDataTable();
