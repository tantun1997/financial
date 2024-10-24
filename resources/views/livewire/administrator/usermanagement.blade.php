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
                <table id="datatablesUserManagement" class="nowrap table table-bordered table-hover"
                    style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ชื่อ-สกุล</th>
                            <th style="text-align: center;">ชื่อผู้ใช้งาน</th>
                            <th style="text-align: center;">แผนก</th>
                            <th style="text-align: center; width: 110px">สถานะ</th>
                            <th style="text-align: center; width: 100px">แอดมิน</th>
                            <th style="text-align: center;">Action</th>
                            {{-- <th style="text-align: center; width: 150px">ปรับปรุงล่าสุด</th> --}}

                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($datatablesUserManagementQuery as $data)
                            <tr>
                                <td>{{ $data->fullName }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->deptName }}</td>
                                <td style="text-align: center;">
                                    <button type="button"
                                        wire:click="enableButton({{ $data->id }}, {{ $data->isStatus }}, '{{ $data->fullName }}')"
                                        class="btn btn-sm btn-{{ $data->isStatus == 'A' ? 'success' : 'danger' }}"
                                        data-toggle="modal" data-target="#myModal">
                                        {{ $data->isStatus == 'A' ? 'เปิดใช้งาน' : 'ปิดใช้งาน' }}
                                    </button>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button"
                                        wire:click="adminButton({{ $data->id }}, {{ $data->isAdmin }}, '{{ $data->fullName }}')"
                                        class="btn btn-sm btn-{{ $data->isAdmin == 'Y' ? 'primary' : 'info' }}"
                                        data-toggle="modal" data-target="#myModal">
                                        {{ $data->isAdmin == 'Y' ? 'Admin' : 'User' }}
                                    </button></td>
                                <td><button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#myModal">
                                        แก้ไข
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#myModal">ลบ
                                    </button>
                                </td>
                                {{-- <td>{{ $data->updatedAt }}</td> --}}
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
        <script src="{{ asset('js/datatables-usermanagement.js') }}"></script>
        <script src="{{ asset('js/swal-function.js') }}"></script>
    </div>
