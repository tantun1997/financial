<div class="container">
    {{-- <h1 class="text-center mb-5 mt-5">แผนการจัดซื้อจัดจ้าง</h1> --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <div class="col">
            <a href="{{ route('maintenance_equip') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนบำรุงรักษา</h4>
                        <h5 style="font-size: 18px">จำนวนแผน: {{ $PLAN_1 }}</h5>

                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('repair_equip') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนซ่อม</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_2 }}</h5>

                    </div>
                </div>
            </a>

        </div>
        <div class="col">
            <a href="{{ route('contract_services') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนจ้างเหมาบริการ</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_3 }}</h5>

                    </div>
                </div>
            </a>

        </div>
        <div class="col">
            <a href="{{ route('calibration') }}" class="card-link">
                <div class="card">

                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนสอบเทียบเครื่องมือ</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_4 }}</h5>

                    </div>
                </div>
            </a>

        </div>
        <div class="col">
            <a href="{{ route('replacement_plan') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนทดแทน</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_5 }}</h5>

                    </div>
                </div>
            </a>

        </div>
        <div class="col">
            <a href="{{ route('potential_plan') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนเพิ่มศักย์ภาพ</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_6 }}</h5>

                    </div>
                </div>
            </a>

        </div>
        <div class="col">
            <a href="{{ route('noserial_plan') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนไม่มีเลขครุภัณฑ์</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_7 }}</h5>

                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('POutsidewarehouse') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนวัสดุนอกคลัง</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_8 }}</h5>

                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('PInsidewarehouse') }}" class="card-link">
                <div class="card">
                    <div class="card-body">

                        <h4 style="font-size: 22px">แผนวัสดุในคลัง</h4>
                        <h5 style="font-size: 18px; ">จำนวนแผน: {{ $PLAN_9 }}</h5>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease;
            display: block;
        }


        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: rgb(135, 207, 240);
            color: #000000
        }

        .card-body {
            padding: 20px;
        }
    </style>

</div>
