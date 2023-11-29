<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> เพิ่มแผนจัดซื้อครุภัณฑ์</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('purchasing_plan') }}">แผนฯจัดซื้อครุภัณฑ์</a>
        </li>
        <li class="breadcrumb-item active">
            เพิ่มแผนจัดซื้อครุภัณฑ์</li>
    </ol>
    <hr>
    <form wire:submit.prevent="add_main()">
        @csrf
        <div class="card">
            <h5 class="card-header">เพิ่มแผนจัดซื้อครุภัณฑ์</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- รหัส ปีงบประมาณ -->
                        <label for="year">ปีงบประมาณ</label>
                        <select class="form-select @error('year') is-invalid @enderror" wire:model.defer="year"
                            id="year" style="width: 100%;" aria-labelledby="year">
                            @php
                                $currentYear = date('Y');
                                $nextYear = $currentYear + 1;
                                $nextYear2 = $currentYear + 2;
                                $displayedNextYear = $nextYear + 543;
                                $displayedNextYear2 = $nextYear2 + 543;

                            @endphp
                            <option value="{{ $nextYear + 543 }}">{{ $displayedNextYear }}</option>
                            <option value="{{ $nextYear2 + 543 }}">{{ $displayedNextYear2 }}</option>
                        </select>
                        @error('year')
                            <span class="text-danger error">โปรดเลือกปีงบประมาณ</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <!-- แผนงาน -->
                        <label for="levelNo">แผนงาน</label>
                        <select class="form-select @error('levelNo') is-invalid @enderror" wire:model.defer="levelNo"
                            id="levelNo" style="width: 100%;" aria-labelledby="levelNo">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            <option value="1">จริง</option>
                            <option value="2">สำรอง</option>
                        </select>
                        @error('levelNo')
                            <span class="text-danger error">โปรดเลือกแผนฯ</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ประเภท -->
                        <label for="request_type">ประเภท</label>
                        <select class="form-select @error('request_type') is-invalid @enderror"
                            wire:model.defer="request_type" id="request_type" style="width: 100%;"
                            aria-labelledby="request_type">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            <option value="1">ทดแทน</option>
                            <option value="2">เพิ่มศักย์ภาพ</option>
                        </select>
                        @error('request_type')
                            <span class="text-danger error">โปรดเลือกประเภทการขอ</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ประเภทงบประมาณ -->
                        <label for="BGS_ID">ประเภทงบประมาณ</label>
                        <select class="form-select @error('BGS_ID') is-invalid @enderror" wire:model.defer="BGS_ID"
                            id="BGS_ID" style="width: 100%;" aria-labelledby="BGS_ID">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            <option value="1">เงินบำรุง / เงินบริจาค</option>
                            <option value="2">งบค่าเสื่อม</option>
                            <option value="3">งบประมาณ</option>
                        </select>
                        @error('BGS_ID')
                            <span class="text-danger error">โปรดเลือกประเภทงบประมาณ</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- ชื่อรายการ -->
                        <label for="description">ชื่อรายการ</label>
                        <input class="form-control @error('description') is-invalid @enderror" type="text"
                            wire:model.defer="description" id="description" list="listDescription" autocomplete="off"
                            style="width: 100%;" placeholder="ชื่อรายการ" aria-labelledby="description">
                        @error('description')
                            <span class="text-danger error">โปรดเลือกชื่อรายการ</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- ราคาต่อหน่วย -->
                        <label for="price">ราคาต่อหน่วย</label>
                        <input class="form-control @error('price') is-invalid @enderror" wire:model.defer="price"
                            id="price" type="text" autocomplete="off" placeholder="ราคาต่อหน่วย">
                        @error('price')
                            <span class="text-danger error">โปรดใส่ราคาต่อหน่วย</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- จำนวน -->
                        <label for="qty">จำนวน</label>
                        <input class="form-control @error('qty') is-invalid @enderror" wire:model.defer="qty"
                            min="1" id="qty" type="number" style="width: 100%;" autocomplete="off"
                            aria-labelledby="qty">
                        @error('qty')
                            <span class="text-danger error">โปรดใส่จำนวน</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ชื่อหน่วยนับ -->
                        <label for="unit">ชื่อหน่วยนับ</label>
                        <input class="form-control @error('unit') is-invalid @enderror" wire:model.defer="unit"
                            id="unit" type="text" style="width: 100%;" maxlength="250" autocomplete="off"
                            placeholder="หน่วย" aria-labelledby="unit">
                        @error('unit')
                            <span class="text-danger error">โปรดใส่ชื่อหน่วยนับและห้ามใส่ตัวเลข</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- เหตุผลและความจำเป็น -->
                        <label for="reason">เหตุผลและความจำเป็น</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" wire:model.defer="reason" id="reason"
                            rows="2" maxlength="250" autocomplete="off" placeholder="เหตุผลและความจำเป็น"></textarea>

                        @error('reason')
                            <span class="text-danger error">โปรดพิมพ์เหตุผลและความจำเป็น</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <!-- หมายเหตุ -->
                        <label for="remark">หมายเหตุ</label>
                        <textarea class="form-control" wire:model.defer="remark" id="remark" type="text" maxlength="250"
                            autocomplete="off" placeholder="หมายเหตุ(ถ้ามี)"></textarea>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4" style="text-align: center ">
            <a class="btn btn-danger" href="{{ route('purchasing_plan') }}" role="button">ยกเลิก</a>
            <input type="submit" class="btn btn-success" value="ยืนยันข้อมูล">
        </div>
    </form>
    <script>
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
    </script>
</div>
