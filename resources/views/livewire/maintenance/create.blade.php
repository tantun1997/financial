<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> เพิ่มแผนงานบำรุงรักษา</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('maintenance_equip') }}">แผนฯบำรุงรักษา</a>
        </li>
        <li class="breadcrumb-item active">
            เพิ่มแผนงานบำรุงรักษา</li>
    </ol>
    <hr>
    <form wire:submit.prevent="addMaintenence()">
        @csrf
        <div class="card">
            <h5 class="card-header">เพิ่มแผนงานบำรุงรักษา</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- รหัส ปีงบประมาณ -->
                        <label for="budget">ปีงบประมาณ</label>
                        <select class="form-select @error('budget') is-invalid @enderror" wire:model.defer="budget"
                            id="budget">
                            @php
                                $currentYear = date('Y');
                                $nextYear = $currentYear + 1;
                                $displayedNextYear = $nextYear + 543;
                            @endphp
                            <option value="{{ $nextYear + 543 }}">{{ $displayedNextYear }}</option>
                            <option value="{{ $currentYear + 543 }}">{{ $currentYear + 543 }}</option>
                        </select>
                        @error('budget')
                            <span class="text-danger error">โปรดเลือกปีงบประมาณ</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ลำดับความสำคัญ -->
                        <label for="priorityNo">ลำดับความสำคัญ</label>
                        <input class="form-control @error('priorityNo') is-invalid @enderror"
                            wire:model.defer="priorityNo" id="priorityNo" type="text" maxlength="3"
                            autocomplete="off">
                        @error('priorityNo')
                            <span class="text-danger error">โปรดใส่ลำดับความสำคัญ (ตัวเลขเท่านั้น)</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ประเภท -->
                        <label for="objectTypeId">ประเภท</label>
                        <select class="form-select @error('objectTypeId') is-invalid @enderror"
                            wire:model.defer="objectTypeId" id="objectTypeId">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($procurement_object as $object)
                                <option value="{{ $object->id }}">
                                    {{ $object->objectName }} </option>
                            @endforeach
                        </select>
                        @error('objectTypeId')
                            <span class="text-danger error">โปรดเลือกประเภท</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- แผนงาน -->
                        <label for="levelNo">แผนงาน</label>
                        <select class="form-select @error('levelNo') is-invalid @enderror" wire:model.defer="levelNo"
                            id="levelNo">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            <option value="1">จริง</option>
                            <option value="2">สำรอง</option>
                        </select>
                        @error('levelNo')
                            <span class="text-danger error">โปรดเลือกแผนงาน</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- ชื่อรายการ -->
                        <label for="description">ชื่อรายการ</label>
                        <input class="form-control @error('description') is-invalid @enderror" type="text"
                            wire:model.defer="description" id="description" list="listDescription" autocomplete="off"
                            placeholder="ชื่อรายการ" wire:change="updateFieldsFromDescription">
                        <datalist id="listDescription">
                            @php
                                $usedNames = [];
                            @endphp
                            @if (Auth::user()->isAdmin == 'Y')
                                @foreach ($VW_NEW_MAINPLAN as $plan)
                                    @if (!in_array($plan->description, $usedNames))
                                        <option value="{{ $plan->description }}">
                                            {{ $plan->price }} </option>
                                        @php
                                            $usedNames[] = $plan->description;
                                        @endphp
                                    @endif
                                @endforeach
                            @else
                                @foreach ($VW_NEW_MAINPLAN as $plan)
                                    @if ($plan->TCHN_LOCAT_ID == Auth::user()->deptId)
                                        @if ($plan->objectTypeId == '01' && !in_array($plan->objectTypeId, $usedNames))
                                            <option value="{{ $plan->description }}">
                                                {{ $plan->price }} </option>
                                            @php
                                                $usedNames[] = $plan->description;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </datalist>
                        @error('description')
                            <span class="text-danger error">โปรดเพิ่มชื่อรายการ</span>
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
                        <label for="quant">จำนวน</label>
                        <input class="form-control @error('quant') is-invalid @enderror" wire:model.defer="quant"
                            min="1" id="quant" type="number" autocomplete="off">

                        @error('quant')
                            <span class="text-danger error">โปรดใส่จำนวน</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ชื่อหน่วยนับ -->
                        <label for="package">ชื่อหน่วยนับ</label>
                        <input class="form-control @error('package') is-invalid @enderror" wire:model.defer="package"
                            id="package" type="text" maxlength="250" autocomplete="off" placeholder="หน่วย">
                        @error('package')
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
            <a class="btn btn-danger" href="{{ route('maintenance_equip') }}" role="button">ยกเลิก</a>
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
