<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Somdet Intranet</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .btn.btn-primary {
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 10px;
        }
    </style>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="text-center mb-4">
                            <img src="assets/img/logo1.png" class="w-50 mb-3" alt="Logo">
                            <h5 class="mb-3">ระบบสร้างแผนงาน</h5>
                            <h5>โรงพยาบาลสมเด็จพระพุทธเลิศหล้า</h5>
                        </div>
                        <div class="card shadow-lg">
                            <h5 class="text-center mt-3">ล็อกอินเข้าใช้งานระบบ</h5>
                            <hr>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="username" id="username" type="text"
                                            placeholder="Username" autocomplete="off" />
                                        <label for="username">ชื่อล็อกอิน</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" id="password" type="password"
                                            placeholder="Password" />
                                        <label for="password">รหัสผ่าน</label>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('เข้าสู่ระบบ') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="d-flex justify-content-center mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column flex-center">
                            <img class="mx-auto mw-100 mb-4" src="assets/img/logo1.png">
                            <h5 class="text-center my-3">ระบบสร้างแผนงาน</h5>
                            <h5 class="text-center my-3">โรงพยาบาลสมเด็จพระพุทธเลิศหล้า</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-lg mt-5">
                            <div class="card-header">
                                <h5 class="text-center my-4">ล็อกอินเข้าใช้งานระบบ</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="username" id="username" type="text"
                                            placeholder="Username" autocomplete="off" />
                                        <label for="username">ชื่อผู้ใช้งาน</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" id="password" type="password"
                                            placeholder="Password" />
                                        <label for="password">รหัสผ่าน</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('เข้าสู่ระบบ') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
