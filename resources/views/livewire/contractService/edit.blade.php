<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> ข้อมูลแผนงานจ้างเหมาบริการ</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('contract_services') }}">แผนฯจ้างเหมาบริการ</a>
        </li>
        <li class="breadcrumb-item active">
            ข้อมูลแผนงานจ้างเหมาบริการ</li>
    </ol>
    <hr>

    @if ($editDetail)
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">แก้ไขแผนงานจ้างเหมาบริการ</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- รหัส ปีงบประมาณ -->
                        <label for="budget">ปีงบประมาณ</label>
                        <select class="form-select @error('budget') is-invalid @enderror" wire:model="budget"
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
                        <input class="form-control @error('priorityNo') is-invalid @enderror" wire:model="priorityNo"
                            id="priorityNo" type="text" maxlength="3" autocomplete="off">
                        @error('priorityNo')
                            <span class="text-danger error">โปรดใส่ลำดับความสำคัญ (ตัวเลขเท่านั้น)</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ประเภท -->
                        <label for="objectTypeId">ประเภท</label>
                        <select class="form-select @error('objectTypeId') is-invalid @enderror"
                            wire:model="objectTypeId" id="objectTypeId">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($procurement_object_edit as $object)
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
                        <select class="form-select @error('levelNo') is-invalid @enderror" wire:model="levelNo"
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
                            wire:model="description" id="description"autocomplete="off" placeholder="ชื่อรายการ">
                        @error('description')
                            <span class="text-danger error">โปรดเพิ่มชื่อรายการ</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- ราคาต่อหน่วย -->
                        <label for="price">ราคาต่อหน่วย</label>
                        <input class="form-control @error('price') is-invalid @enderror" wire:model="price"
                            id="price" type="text" autocomplete="off" placeholder="ราคาต่อหน่วย">
                        @error('price')
                            <span class="text-danger error">โปรดใส่ราคาต่อหน่วย</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- จำนวน -->
                        <label for="quant">จำนวน</label>
                        <input class="form-control @error('quant') is-invalid @enderror" wire:model="quant"
                            min="1" id="quant" type="number" autocomplete="off">

                        @error('quant')
                            <span class="text-danger error">โปรดใส่จำนวน</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <!-- ชื่อหน่วยนับ -->
                        <label for="package">ชื่อหน่วยนับ</label>
                        <input class="form-control @error('package') is-invalid @enderror" wire:model="package"
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
                        <textarea class="form-control @error('reason') is-invalid @enderror" wire:model="reason" id="reason" rows="2"
                            maxlength="250" autocomplete="off" placeholder="เหตุผลและความจำเป็น"></textarea>

                        @error('reason')
                            <span class="text-danger error">โปรดพิมพ์เหตุผลและความจำเป็น</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <!-- หมายเหตุ -->
                        <label for="remark">หมายเหตุ</label>
                        <textarea class="form-control" wire:model="remark" id="remark" type="text" maxlength="250"
                            autocomplete="off" placeholder="หมายเหตุ(ถ้ามี)"></textarea>
                        @error('remark')
                            <span class="text-danger error">โปรดใส่ลำดับความสำคัญ (ตัวเลขเท่านั้น)</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4" style="text-align: center ">
            <a class="btn btn-outline-danger "
                href="{{ route('detail_contract_services', ['id' => $edit_id]) }}">ย้อนกลับ</a>
            <button wire:click="update" class="btn btn-outline-success">ยืนยันข้อมูล</button>
        </div>
    @else
        <div class="row">
            <div class="col-md-3" wire:ignore>
                @foreach ($VW_NEW_MAINPLAN as $item)
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <div>
                            <a class="btn btn-outline-primary" href="{{ route('contract_services') }}">ย้อนกลับ</a>
                        </div>
                        <div style="display: flex; align-items: center;">

                            <button wire:click="editMainEquip({{ $item->id }})" class="btn btn-outline-danger">
                                <i class="fa-solid fa-pen fa-xs"></i> แก้ไขข้อมูล
                            </button>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        @if ($item->approved == '1')
                            <button onclick="generatePdf({{ $item->id }})" class="btn btn-danger btn-sm"
                                style="width: 100%"><i class="fa-duotone fa-file-pdf fa-lg"></i> PDF</button>
                        @else
                            <div class="alert alert-secondary" role="alert">
                                ยังไม่สามารถปริ้นได้
                            </div>
                        @endif
                    </div>
                    <table class="table table-bordered table-striped table-sm" style="width: 100%;">

                        <tr>
                            <td class="form-text" style="text-align: center">ID</td>
                            <td class="form-text" style="text-align: center">ปี</td>
                            <td class="form-text" style="text-align: center">ลำดับความสำคัญ</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">{{ $item->id }}</td>
                            <td style="text-align: center">{{ $item->budget }}</td>
                            <td style="text-align: center">{{ $item->priorityNo }}</td>

                        </tr>
                        <tr>
                            <td class="form-text" style="text-align: center">แผนฯ</td>
                            <td class="form-text" colspan="2" style="text-align: center">ประเภท</td>
                        </tr>
                        <tr>
                            <td style="text-align: center">
                                @if ($item->levelNo == 1)
                                    จริง
                                @elseif($item->levelNo == 2)
                                    สำรอง
                                @endif
                            </td>
                            <td colspan="2" style="text-align: center">{{ $item->objectName }}</td>
                        </tr>
                        <tr>
                            <td class="form-text" colspan="3">ชื่อรายการ</td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $item->description }}</td>
                        </tr>
                        <tr>
                            <td class="form-text" colspan="2">ราคาต่อหน่วย</td>
                            <td class="form-text" style="text-align: center">จำนวน</td>
                        </tr>
                        <tr>
                            <td colspan="2">{{ number_format(round($item->price, 2), 2) }}
                                บาท</td>
                            <td style="text-align: center">
                                {{ $item->quant }} {{ $item->package }}</td>
                        </tr>
                        <tr>
                            <td class="form-text" colspan="3" style="text-align: center">วงเงินรวม</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center">
                                {{ number_format(round($item->price * $item->quant, 2), 2) }}
                                บาท
                            </td>
                        </tr>
                        <tr>
                            <td class="form-text" colspan="3">เหตุผลและความจำเป็น</td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $item->reason }}</td>
                        </tr>
                        <tr>
                            <td class="form-text" colspan="3">หมายเหตุ</td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ $item->remark }}</td>
                        </tr>
                        <tr>
                            <td class="form-text" colspan="2">หน่วยงานที่เบิก</td>
                            <td class="form-text">วันที่ปรับปรุงข้อมูล</td>

                        </tr>

                        <tr>
                            <td colspan="2">{{ $item->TCHN_LOCAT_NAME }}</td>

                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    </table>
                @endforeach
            </div>

            <div class="col-md-9">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div style="display: flex; align-items: center;">
                        <button wire:click="addRow({{ $edit_id }})" class="btn btn-outline-success">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> เพิ่ม
                        </button>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">ข้อมูลรายการ</h5>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @elseif (session()->has('warning'))
                            <div class="alert alert-warning" role="alert">
                                {{ session()->get('warning') }}
                            </div>
                        @endif
                        <div style="max-height: 100%; overflow-x: scroll;">
                            <table class="table table-bordered table-hover table-sm" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ครั้งที่</th>
                                        <th style="text-align: center;">เลือก</th>
                                        <th style="text-align: center;">ชื่อรายการ</th>
                                        <th style="text-align: center;">ราคาต่อหน่วย(บาท)</th>
                                        <th style="text-align: center;">จำนวน</th>
                                        <th style="text-align: center;">รวมเป็นเงิน(บาท)</th>
                                        <th style="text-align: center;">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $start_number = 1; @endphp

                                    @foreach ($procurements_detail as $query)
                                        @if ($query->PROC_ID == $edit_id)
                                            <tr>
                                                <td style="text-align: center;">{{ $start_number++ }}</td>
                                                <td style="text-align: center;">
                                                    <input class="form-check-input" type="radio"
                                                        wire:click="CheckedEquip({{ $query->id }})"
                                                        id="flexRadioDefault({{ $query->id }})"
                                                        @if ($query->used != 0) checked @endif>
                                                </td>
                                                <td style="text-align: center; white-space: nowrap;">
                                                    @if ($editName == $query->id)
                                                        <input class="form-control" wire:model="EQUP_NAME"
                                                            id="EQUP_NAME" type="text" style="width: 100%;"
                                                            autocomplete="off">
                                                        <button type="button"
                                                            wire:click="acceptNameEquip({{ $query->id }})"
                                                            class="btn btn-primary btn-sm">ยืนยัน</button>
                                                        <button type="button"
                                                            wire:click="cancelNameEquip({{ $query->id }})"
                                                            class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                    @else
                                                        {{ $query->EQUP_NAME }}
                                                        <button wire:click="editNameEquip({{ $query->id }})"
                                                            class="btn btn-outline-danger btn-sm">
                                                            <i class="fa-solid fa-pen fa-2xs"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    @if ($query->currentPrice == null)
                                                        @if ($editingId == $query->id)
                                                            <input class="form-control" min="1"
                                                                wire:model="currentPrice" id="currentPrice"
                                                                type="number" style="width: 100%;"
                                                                autocomplete="off" placeholder="ราคาประเมินจริง">
                                                            <button type="button"
                                                                wire:click="acceptCurrPrice({{ $query->id }})"
                                                                class="btn btn-success btn-sm">ยืนยัน</button>
                                                            <button type="button"
                                                                wire:click="cancelCurrPrice({{ $query->id }})"
                                                                class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                        @else
                                                            <button type="button"
                                                                wire:click="addCurrPrice({{ $query->id }})"
                                                                class="btn btn-success btn-sm">เพิ่มราคา</button>
                                                        @endif
                                                    @else
                                                        @if ($editingId == $query->id)
                                                            <input class="form-control" min="1"
                                                                wire:model="currentPrice" id="currentPrice"
                                                                type="number" style="width: 100%;"
                                                                autocomplete="off" placeholder="ราคาประเมินจริง">
                                                            <button type="button"
                                                                wire:click="acceptCurrPrice({{ $query->id }})"
                                                                class="btn btn-success btn-sm">ยืนยัน</button>
                                                            <button type="button"
                                                                wire:click="cancelCurrPrice({{ $query->id }})"
                                                                class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                        @else
                                                            {{ number_format(round($query->currentPrice, 2), 2) }}
                                                            <button wire:click="addCurrPrice({{ $query->id }})"
                                                                class="btn btn-outline-danger btn-sm">
                                                                <i class="fa-solid fa-pen fa-2xs"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td style="text-align: center; white-space: nowrap;">
                                                    @if ($query->qty == null)
                                                        @if ($editQty == $query->id)
                                                            <input class="form-control" wire:model="qty"
                                                                id="qty" type="text" style="width: 100%;"
                                                                autocomplete="off">
                                                            <button type="button"
                                                                wire:click="acceptQty({{ $query->id }})"
                                                                class="btn btn-primary btn-sm">ยืนยัน</button>
                                                            <button type="button"
                                                                wire:click="cancelQty({{ $query->id }})"
                                                                class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                        @else
                                                            <button type="button"
                                                                wire:click="addQty({{ $query->id }})"
                                                                class="btn btn-success btn-sm">เพิ่มจำนวน</button>
                                                        @endif
                                                    @else
                                                        @if ($editQty == $query->id)
                                                            <input class="form-control" wire:model="qty"
                                                                id="qty" type="text" style="width: 100%;"
                                                                autocomplete="off">
                                                            <button type="button"
                                                                wire:click="acceptQty({{ $query->id }})"
                                                                class="btn btn-primary btn-sm">ยืนยัน</button>
                                                            <button type="button"
                                                                wire:click="cancelQty({{ $query->id }})"
                                                                class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                        @else
                                                            {{ $query->qty }} {{ $query->unit }}
                                                            <button wire:click="addQty({{ $query->id }})"
                                                                class="btn btn-outline-danger btn-sm">
                                                                <i class="fa-solid fa-pen fa-2xs"></i>
                                                            </button>
                                                        @endif
                                                    @endif


                                                </td>
                                                <td style="text-align: center;">
                                                    {{ number_format(round($query->currentPrice * $query->qty, 2), 2) }}
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button"
                                                        wire:click="deleteRow({{ $query->id }})"
                                                        class="btn btn-outline-danger btn-sm">-</button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <style>
        .breadcrumb a {
            text-decoration: none;
            color: #000000;
        }
    </style>
    <script>
        function generatePdf(id) {
            // window.location.href = '/generatePdf/' + id;
            window.open('/contactPdf/' + id, '_blank');
        }

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
