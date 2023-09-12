    <div class="container-fluid px-4">
        <h1 class="mt-4">จัดการผู้ใช้งาน</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="\">จัดการระบบ</a></li>
            <li class="breadcrumb-item
                    active">ผู้ใช้งาน</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                รายชื่อผู้ใช้งาน
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <select id="LengthMenu" class="form-select">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <div class="input-group-text">รายการ</div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="col-7">

                    </div>

                    <div class="col-3">
                        <div class="input-group">
                            <!--<div class="input-group-text">ค้นหา</div>-->
                            <input type="search" class="form-control" id="SearchMenu" placeholder="ค้นหา">
                        </div>
                    </div>
                </div>
                <table id="datatablesUserManagement" class="nowrap table table-bordered table-hover"
                    style="width: 100%; text-align: center; border-top: 1px solid #ddd; ">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ชื่อ-สกุล</th>
                            <th style="text-align: center;">ชื่อผู้ใช้งาน</th>
                            <th style="text-align: center;">แผนก</th>
                            <th style="text-align: center; width: 110px">สถานะ</th>
                            <th style="text-align: center; width: 100px">แอดมิน</th>
                            <th style="text-align: center;">Action</th>
                            <th style="text-align: center; width: 150px">ปรับปรุงล่าสุด</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datatablesUserManagementQuery as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->deptName }}</td>
                                <td style="text-align: center;">
                                    <button type="button" 
                                        wire:click="enableButton({{ $data->userId }}, {{ $data->enable }}, '{{ $data->name }}')"
                                        class="btn btn-sm btn-{{ $data->enable == 1 ? 'success' : 'danger' }}"
                                        data-toggle="modal" data-target="#myModal">
                                        {{ $data->enable == 1 ? 'เปิดใช้งาน' : 'ปิดใช้งาน' }}
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" 
                                        wire:click="adminButton({{ $data->userId }}, {{ $data->isAdmin }}, '{{ $data->name }}')"
                                        class="btn btn-sm btn-{{ $data->isAdmin == 1 ? 'primary' : 'info' }}"
                                        data-toggle="modal" data-target="#myModal">
                                        {{ $data->isAdmin == 1 ? 'Admin' : 'User' }}
                                    </button></td>
                                <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#myModal">
                                        แก้ไข
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#myModal">ลบ
                                    </button>
                                </td>
                                <td>{{ $data->updatedAt }}</td>
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
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('js/datatables-usermanagement.js') }}"></script>
        <script src="{{ asset('js/swal-function.js') }}"></script>
    </div>
