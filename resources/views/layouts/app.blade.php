<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ระบบสร้างแผนงานครุภัณฑ์</title>
    {{-- <link rel="icon" type="image/x-icon" href="assets/img/logo1.png"> --}}
    <link rel="shortcut icon" href="assets/img/logo1.png" type="image/x-icon">

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    @livewireStyles
    <style>
        .navbar {
            background-color: #42a5f5;
        }

        .navbar-nav .nav-link:hover {
            transform: scale(1.05);
            color: #ffffff;
        }
    </style>



</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">ระบบสร้างแผนงานครุภัณฑ์</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <a class="nav-item nav-link" href="/"><i class="fa-regular fa-house"></i> หน้าแรก</a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fa-solid fa-list"></i> แผนการจัดซื้อจัดจ้าง
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('maintenance_equip') }}">บำรุงรักษา </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('repair_equip') }}">
                                    ซ่อม </a> </li>
                            <li><a class="dropdown-item" href="{{ route('contract_services') }}">
                                    จ้างเหมาบริการ </a> </li>
                            <li><a class="dropdown-item" href="{{ route('calibration') }}">
                                    สอบเทียบเครื่องมือ </a> </li>
                            <li><a class="dropdown-item" href="{{ route('replacement_plan') }}">
                                    ทดแทน </a> </li>
                            <li><a class="dropdown-item" href="{{ route('potential_plan') }}">
                                    เพิ่มศักย์ภาพ </a> </li>
                            <li><a class="dropdown-item" href="{{ route('noserial_plan') }}">
                                    ไม่มีเลขครุภัณฑ์ </a> </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fa-solid fa-list"></i> วัสดุคลังย่อย
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('POutsidewarehouse') }}">วัสดุนอกคลัง </a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('PInsidewarehouse') }}">
                                    วัสดุในคลัง </a> </li>
                        </ul>
                    </li>

                    @if (Auth::user()->isAdmin == 'Y')
                        <a class="nav-item nav-link" href="{{ route('financial_report') }}"><i
                                class="fa-regular fa-database"></i> รายงานทางการเงิน</a>
                        @if (Auth::user()->id == '114000041')
                            <a class="nav-item nav-link" href="{{ route('approved_items') }}">
                                @if ($count_request > 0)
                                    <span class="badge bg-danger">{{ $count_request }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                                รายการขออนุมัติ
                            </a>
                        @endif
                    @endif

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-user fa-fw"></i> {{ Auth::user()->fullName }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                        {{ __('ออกจากระบบ') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @livewireScripts
</body>

</html>
