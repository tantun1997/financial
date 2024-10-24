<div class="container-fluid">
    <h3 class="mt-3 mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
            style="fill: rgb(56, 155, 236);">
            <path d="M3 3v17a1 1 0 0 0 1 1h17v-2H5V3H3z"></path>
            <path
                d="M15.293 14.707a.999.999 0 0 0 1.414 0l5-5-1.414-1.414L16 12.586l-2.293-2.293a.999.999 0 0 0-1.414 0l-5 5 1.414 1.414L13 12.414l2.293 2.293z">
            </path>
        </svg> เพิ่มแผนงานเพิ่มศักยภาพ</h3>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a class="btn btn-danger" href="{{ route('potential_plan') }}" role="button">ย้อนกลับ</a>
        <button type="button" wire:click="save" class="btn btn-success">ดำเนินการต่อ</button>

    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <h5 class="card-header bg-gradient-primary text-white py-3"
                    style="background-color: #566573;color: white">
                    <i class="far fa-edit mr-2"></i>
                    แผนงานเพิ่มศักยภาพ
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 mb-3">
                            <span>ปีงบประมาณ</span>
                            <select class="form-select @error('Plan_YEAR') is-invalid @enderror" wire:model="Plan_YEAR"
                                id="Plan_YEAR">
                                <option value="" selected>เลือก</option>
                                @php
                                    $currentYear = date('Y');
                                    $nextYear2 = $currentYear + 2;
                                    $nextYear = $currentYear + 1;
                                    $displayedNextYear = $nextYear + 543;
                                    $displayedNextYear2 = $nextYear2 + 543;
                                @endphp
                                <option value="{{ $nextYear2 + 543 }}">{{ $displayedNextYear2 }}</option>
                                <option value="{{ $nextYear + 543 }}">{{ $displayedNextYear }}</option>
                                <option value="{{ $currentYear + 543 }}">{{ $currentYear + 543 }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <span>แผนฯ</span>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  @error('Plan_LEVEL') is-invalid @enderror"
                                    type="radio" wire:model="Plan_LEVEL" value="1">
                                <label class="form-check-label">จริง</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input  @error('Plan_LEVEL') is-invalid @enderror"
                                    type="radio" wire:model="Plan_LEVEL" value="2">
                                <label class="form-check-label">สำรอง</label>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <span>ประเภทงบ</span>
                            <select class="form-select" wire:model="Plan_BUDGET" id="Plan_BUDGET">
                                <option value="" selected>เลือก</option>
                                @foreach ($DimBudget as $item)
                                    <option value="{{ $item->BudgetID }}">
                                        {{ $item->Budget }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <span>ประเภทแผน</span>
                            <select class="form-select @error('Plan_TYPE_ID') is-invalid @enderror"
                                wire:model="Plan_TYPE_ID" id="Plan_TYPE_ID">
                                <option value="" selected>เลือก</option>
                                @foreach ($EQUIPMENT_TYPE as $item)
                                    <option value="{{ $item->TYPE_ID }}">
                                        {{ $item->TYPE_NAME }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 mb-3">
                            <span>ชื่อแผนงาน</span>
                            <input class="form-control @error('Plan_NAME') is-invalid @enderror" type="text"
                                wire:model="Plan_NAME" id="Plan_NAME" placeholder="ชื่อแผนงาน">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <span>ราคาต่อหน่วย</span>
                            <input class="form-control @error('Plan_PRICE_OVERALL') is-invalid @enderror" type="number"
                                wire:model="Plan_PRICE_OVERALL" id="Plan_PRICE_OVERALL" placeholder="ราคาต่อหน่วย">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <span>จำนวนครุภัณฑ์</span>
                            <input class="form-control @error('Plan_AMOUNT') is-invalid @enderror" type="number"
                                wire:model="Plan_AMOUNT" id="Plan_AMOUNT" placeholder="จำนวนครุภัณฑ์">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <span>เหตุผลและความจำเป็น</span>
                            <textarea class="form-control @error('Plan_REASON') is-invalid @enderror" id="Plan_REASON" wire:model="Plan_REASON"
                                placeholder="เหตุผลและความจำเป็น"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <span>หมายเหตุ</span>
                            <textarea class="form-control" id="Plan_REMARK" wire:model="Plan_REMARK" placeholder="หมายเหตุ (ถ้ามี)"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        };
        if (event.detail.refresh) {
            setTimeout(function() {
                // รับค่าไอดีจาก URL โดยใช้ query string parameter
                const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                const url = `http://192.168.2.142/potential_plan/detail?id=${id}`;
                window.location.href = url;
            }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
        }
    });


    window.addEventListener('alert_select', event => {
        toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        };
    });
</script>
</div>
