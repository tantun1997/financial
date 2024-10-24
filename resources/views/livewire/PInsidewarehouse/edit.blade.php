<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3">รายละเอียดแผนวัสดุในคลัง</h3>

    <hr>
    @if ($show_equip)
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div>
                <a class="btn btn-outline-primary"
                    href="http://192.168.2.142/PInsidewarehouse/detail?id={{ $Plan_ID }}">ย้อนกลับ</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <h5 class="card-header" style="background-color: rgb(24, 138, 245);color: white"><i
                            class="far fa-edit"></i>
                        วัสดุนอกคลัง</h5>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">เลือก</th>
                                    <th style="text-align: left;">รายการ</th>
                                    <th style="text-align: center;">สถานะ</th>
                                    {{-- <th style="text-align: center;">เพิ่มเติม</th> --}}
                                    <th style="text-align: center; width: 5%">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($edit_equip)
                                    @foreach ($EQUIPMENT_LIST as $query)
                                        @if ($Equip_ID == $query->Equip_ID)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    @if ($query->Equip_CURRENT_PRICE == null)
                                                        <small style="color: red;">ใส่ราคา</small>
                                                    @else
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:click="CheckedEquip({{ $query->Equip_ID }})"
                                                            @if ($query->Equip_USED != 0) checked @endif>
                                                    @endif
                                                </td>

                                                <td
                                                    style="text-align: left; white-space: nowrap; vertical-align: middle;">
                                                    <small>
                                                        หมายเลข: {{ $query->Equip_SERIAL_NUMBER }} <br>
                                                        <textarea class="form-control mb-2" wire:model="Equip_NAME" type="text"></textarea>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text">ราคา</span>
                                                            <input class="form-control" min="1"
                                                                wire:model="Equip_CURRENT_PRICE" type="number"
                                                                placeholder="ราคา">
                                                        </div>
                                                        <div class="input-group ">
                                                            <span class="input-group-text">จำนวน</span>
                                                            <input class="form-control" min="1"
                                                                wire:model="Equip_AMOUNT" type="number"
                                                                placeholder="จำนวน">
                                                        </div>
                                                    </small>
                                                </td>
                                                <td style="text-align: center; white-space: nowrap;">
                                                    <select class="form-select" wire:model="Equip_STATUS">
                                                        <option value="" selected>เลือก</option>
                                                        @foreach ($EQUIPMENT_STATUS as $item)
                                                            <option value="{{ $item->STATUS_ID }}">
                                                                {{ $item->STATUS_NAME }} </option>
                                                        @endforeach
                                                    </select>
                                                    {{ $query->Equip_STATUS_DATE }}

                                                </td>
                                                {{-- <td style="text-align: left; white-space: nowrap;">
                                                    <small>
                                                        แผนก: {{ $query->TCHN_LOCAT_NAME }}<br>
                                                        อายุการใช้งาน: {{ number_format($query->Equip_AGE) }}
                                                        ปี<br>
                                                        ราคาของวัสดุ: {{ number_format($query->Equip_PRICE) }}
                                                        บาท
                                                    </small>
                                                </td> --}}
                                                <td
                                                    style="text-align: center; white-space: nowrap; vertical-align: middle;">
                                                    <button type="button"
                                                        wire:click="save_equip({{ $query->Equip_ID }})"
                                                        class="btn btn-outline-success btn-sm">บันทึก</button>
                                                    <a class="btn btn-outline-danger btn-sm"
                                                        href="http://192.168.2.142/PInsidewarehouse/detail?id={{ $Plan_ID }}">ยกเลิก</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($EQUIPMENT_LIST as $query)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if ($query->Equip_CURRENT_PRICE == null)
                                                    <small style="color: red;">ใส่ราคา</small>
                                                @else
                                                    <input class="form-check-input" type="checkbox"
                                                        wire:click="CheckedEquip({{ $query->Equip_ID }})"
                                                        @if ($query->Equip_USED != 0) checked @endif>
                                                @endif
                                            </td>

                                            <td style="text-align: left; white-space: nowrap;">
                                                <small>
                                                    หมายเลข: {{ $query->Equip_SERIAL_NUMBER }} <br>
                                                    ชื่อรายการ: {{ $query->Equip_NAME }} <br>
                                                    ราคา:
                                                    {{ number_format(round($query->Equip_CURRENT_PRICE, 2), 2) }}
                                                    บาท
                                                    <br>
                                                    จำนวน:
                                                    {{ number_format(round($query->Equip_AMOUNT, 2), 0) }}
                                                </small>
                                            </td>
                                            <td
                                                style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                                <small>{{ $query->STATUS_NAME }} <br>
                                                    {{ $query->Equip_STATUS_DATE }}</small>

                                            </td>
                                            {{-- <td style="text-align: left; white-space: nowrap;">
                                                <small>
                                                    แผนก: {{ $query->TCHN_LOCAT_NAME }}<br>
                                                    อายุการใช้งาน: {{ number_format($query->Equip_AGE) }}
                                                    ปี<br>
                                                    ราคาของวัสดุ: {{ number_format($query->Equip_PRICE) }} บาท
                                                </small>
                                            </td> --}}
                                            <td
                                                style="text-align: center; white-space: nowrap; vertical-align: middle;">
                                                <button type="button" wire:click="edit_equip({{ $query->Equip_ID }})"
                                                    class="btn btn-outline-danger btn-sm">แก้ไข</button>
                                                <button type="button" wire:click="deleteRow({{ $query->Equip_ID }})"
                                                    class="btn btn-outline-secondary btn-sm">ลบ</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{ $EQUIPMENT_LIST->links() }}
                        ทั้งหมด: {{ $EQUIPMENT_LIST->total() }} รายการ


                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <h5 class="card-header" style="background-color: rgb(16, 107, 39);color: white"><i
                            class="fa-regular fa-magnifying-glass"></i>
                        ค้นหารายการวัสดุ</h5>
                    <div class="card-body">
                        <input class="form-control" wire:model="search_EQUIP" type="search" placeholder="ค้นหารายการ">
                        <br>
                        @if ($showTable)
                            <div style="max-height: 100%; overflow-x: scroll;">
                                <table class="table table-bordered table-hover table-sm" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">เพิ่ม</th>
                                            <th style="text-align: left;">รายการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($VW_EQUIPMENT as $query)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <button type="button" class="btn btn-outline-success btn-sm"
                                                        wire:click="selectRow({{ $query->PRODCT_LINK_NO }})">
                                                        +
                                                    </button>
                                                </td>
                                                <td style="text-align: left; white-space: nowrap; width: 90%">
                                                    หมวดสินค้า: {{ $query->PRODCT_CAT_NAME }}<br>
                                                    ชื่อรายการ: {{ $query->PRODCT_NAME }} <br>
                                                    ราคา: {{ number_format($query->PRODCT_MIN_COSTRATE) }} บาท
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $VW_EQUIPMENT->links() }}
                                ทั้งหมด: {{ $VW_EQUIPMENT->total() }} รายการ
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-4">
                @if ($edit_plan)
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <div>
                            <a class="btn btn-outline-primary" href="{{ route('PInsidewarehouse') }}">ย้อนกลับ</a>
                        </div>
                        <div style="display: flex; align-items: center;">
                            <a class="btn btn-outline-danger"
                                href="http://192.168.2.142/PInsidewarehouse/detail?id={{ $Plan_ID }}">ยกเลิก</a>
                            <button type="button" wire:click="save_plan" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                @else
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <div>
                            <a class="btn btn-outline-primary" href="{{ route('PInsidewarehouse') }}">ย้อนกลับ</a>
                        </div>
                        <div style="display: flex; align-items: center;">

                            <button type="button" wire:click="edit_plan"
                                class="btn btn-outline-danger">แก้ไขข้อมูล</button>

                        </div>
                    </div>
                @endif
                <div class="card mb-3">
                    <h5 class="card-header" style="background-color: rgb(24, 138, 245);color: white"><i
                            class="far fa-edit"></i>
                        ข้อมูลแผนวัสดุในคลัง</h5>
                    @if ($edit_plan)
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm" style="width: 100%;">
                                <tr>
                                    <td class="form-text" style="text-align: center">ปีงบประมาณ</td>
                                    <td class="form-text" style="text-align: center">หมายเลขแผน</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center"> <select
                                            class="form-select @error('Plan_YEAR') is-invalid @enderror"
                                            wire:model="Plan_YEAR" id="Plan_YEAR">
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
                                            <option value="{{ $currentYear + 543 }}">{{ $currentYear + 543 }}
                                            </option>
                                        </select></td>
                                    <td style="text-align: center">{{ $Plan_ID }}</td>
                                </tr>
                                <tr>
                                    <td class="form-text" style="text-align: center">ประเภทแผน</td>
                                    <td class="form-text" style="text-align: center">แผนฯ</td>

                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <select class="form-select @error('Plan_TYPE_ID') is-invalid @enderror"
                                            wire:model="Plan_TYPE_ID" id="Plan_TYPE_ID">
                                            <option value="" selected>เลือก</option>
                                            @foreach ($EQUIPMENT_TYPE as $item)
                                                <option value="{{ $item->TYPE_ID }}">
                                                    {{ $item->TYPE_NAME }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="text-align: center">
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
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-text" colspan="2">ชื่อแผน</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="word-break: break-all;">
                                        <input class="form-control @error('Plan_NAME') is-invalid @enderror"
                                            type="text" wire:model="Plan_NAME" id="Plan_NAME"
                                            placeholder="ชื่อแผนงาน">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-text" style="text-align: center">ราคาต่อหน่วย</td>
                                    <td class="form-text" style="text-align: center">จำนวนวัสดุ</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <input class="form-control @error('Plan_PRICE_OVERALL') is-invalid @enderror"
                                            type="number" wire:model="Plan_PRICE_OVERALL" id="Plan_PRICE_OVERALL"
                                            placeholder="ราคาต่อหน่วย">
                                    </td>
                                    <td style="text-align: center">
                                        <input class="form-control @error('Plan_AMOUNT') is-invalid @enderror"
                                            type="number" wire:model="Plan_AMOUNT" id="Plan_AMOUNT"
                                            placeholder="จำนวนวัสดุ">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-text" style="text-align: center">ประเภทงบ</td>
                                    <td class="form-text" style="text-align: center;">วงเงินรวม
                                    </td>
                                </tr>
                                <tr>
                                    <td> <select class="form-select" wire:model="Plan_BUDGET" id="Plan_BUDGET">
                                            <option value="" selected>เลือก</option>
                                            @foreach ($DimBudget as $item)
                                                <option value="{{ $item->BudgetID }}">
                                                    {{ $item->Budget }} </option>
                                            @endforeach
                                        </select></td>

                                    <td style="text-align: center;">
                                        {{ number_format(round($EQUIPMENT_PLAN->Plan_PRICE_OVERALL * $EQUIPMENT_PLAN->Plan_AMOUNT, 2), 2) }}
                                        บาท
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-text" colspan="2">เหตุผลและความจำเป็น</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="word-break: break-all;">
                                        <textarea class="form-control @error('Plan_REASON') is-invalid @enderror" id="Plan_REASON" wire:model="Plan_REASON"
                                            placeholder="เหตุผลและความจำเป็น" rows="4"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-text" colspan="2">หมายเหตุ</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="word-break: break-all;">
                                        <textarea class="form-control" id="Plan_REMARK" wire:model="Plan_REMARK" placeholder="หมายเหตุ (ถ้ามี)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="form-text">หน่วยงานที่เบิก</td>
                                    <td class="form-text">วันที่สร้างแผน</td>

                                </tr>

                                <tr>
                                    <td style="word-break: break-all;">{{ $EQUIPMENT_PLAN->TCHN_LOCAT_NAME }}</td>
                                    <td>{{ $EQUIPMENT_PLAN->Plan_DATE }}</td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm" style="width: 100%;">
                                @if ($EQUIPMENT_PLAN)
                                    <tr>
                                        <td class="form-text" style="text-align: center">ปีงบประมาณ</td>
                                        <td class="form-text" style="text-align: center">หมายเลขแผน</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">{{ $EQUIPMENT_PLAN->Plan_YEAR }}</td>
                                        <td style="text-align: center">{{ $EQUIPMENT_PLAN->Plan_ID }}</td>
                                    </tr>

                                    <tr>
                                        <td class="form-text" style="text-align: center">ประเภทแผน</td>
                                        <td class="form-text" style="text-align: center">แผนฯ</td>

                                    </tr>
                                    <tr>
                                        <td style="text-align: center">{{ $EQUIPMENT_PLAN->TYPE_NAME }}</td>
                                        <td style="text-align: center">
                                            @if ($EQUIPMENT_PLAN->Plan_LEVEL == 1)
                                                <span style="color: rgb(51, 148, 6)">จริง</span>
                                            @elseif($EQUIPMENT_PLAN->Plan_LEVEL == 2)
                                                <span style="color: rgb(255, 0, 0)">สำรอง</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form-text" colspan="2">ชื่อแผน</td>

                                    </tr>
                                    <tr>
                                        <td style="word-break: break-all;" colspan="2">
                                            {{ $EQUIPMENT_PLAN->Plan_NAME }}
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form-text" style="text-align: center">ราคาต่อหน่วย</td>
                                        <td class="form-text" style="text-align: center">จำนวนวัสดุ</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">
                                            {{ number_format(round($EQUIPMENT_PLAN->Plan_PRICE_OVERALL, 2), 2) }}
                                            บาท</td>
                                        <td style="text-align: center">
                                            {{ number_format(round($EQUIPMENT_PLAN->Plan_AMOUNT, 2), 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="form-text" style="text-align: center">ประเภทงบ</td>
                                        <td class="form-text" style="text-align: center;">วงเงินรวม</td>

                                    </tr>
                                    <tr>
                                        <td style="text-align: center">{{ $EQUIPMENT_PLAN->Budget }}</td>
                                        <td style="text-align: center;">
                                            {{ number_format(round($EQUIPMENT_PLAN->Plan_PRICE_OVERALL * $EQUIPMENT_PLAN->Plan_AMOUNT, 2), 2) }}
                                            บาท
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="form-text" colspan="2">เหตุผลและความจำเป็น</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="word-break: break-all;">
                                            {{ $EQUIPMENT_PLAN->Plan_REASON }}</td>
                                    </tr>
                                    <tr>
                                        <td class="form-text" colspan="2">หมายเหตุ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="word-break: break-all;">
                                            {{ $EQUIPMENT_PLAN->Plan_REMARK }}</td>
                                    </tr>
                                    <tr>
                                        <td class="form-text">หน่วยงานที่เบิก</td>
                                        <td class="form-text">วันที่สร้างแผน</td>

                                    </tr>
                                    <tr>
                                        <td style="word-break: break-all;">{{ $EQUIPMENT_PLAN->TCHN_LOCAT_NAME }}</td>
                                        <td>{{ $EQUIPMENT_PLAN->Plan_DATE }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div style="display: flex; align-items: center;">
                        <button wire:click="show_equip" class="btn btn-outline-success">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i> เพิ่มวัสดุ
                        </button>
                        @if ($EQUIPMENT_PLAN->Plan_ENABLE == '2')
                            <button onclick="generatePdf({{ $Plan_ID }})" class="btn btn-danger"><i
                                    class="fa-duotone fa-file-pdf fa-lg"></i> PDF</button>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header" style="background-color: rgb(24, 138, 245);color: white"><i
                            class="far fa-edit"></i>
                        วัสดุนอกคลัง</h5>
                    <div class="card-body">
                        ราคาประเมินจริงรวมทั้งหมด:
                        <span
                            style="color: rgb(7, 149, 231)">{{ number_format(round($EQUIPMENT_PLAN->Total_Current_Price, 2), 0) }}
                        </span>บาท
                        คงเหลือ:
                        <span style="color: {{ $EQUIPMENT_PLAN->Remaining_Price < 0 ? 'red' : 'green' }}">
                            {{ number_format(round($EQUIPMENT_PLAN->Remaining_Price, 2), 0) }}
                        </span> บาท
                        <div style="max-height: 100%; overflow-x: scroll;">
                            <table class="table table-bordered table-hover table-sm" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">เลือก</th>
                                        <th style="text-align: left;">รายการ</th>
                                        <th style="text-align: center;">สถานะ</th>
                                        {{-- <th style="text-align: left;">เพิ่มเติม</th> --}}
                                        <th style="text-align: center; width: 5%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($edit_equip)
                                        @foreach ($EQUIPMENT_LIST as $query)
                                            @if ($Equip_ID == $query->Equip_ID)
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        @if ($query->Equip_CURRENT_PRICE == null)
                                                            <small style="color: red;">ใส่ราคา</small>
                                                        @else
                                                            <input class="form-check-input" type="checkbox"
                                                                wire:click="CheckedEquip({{ $query->Equip_ID }})"
                                                                @if ($query->Equip_USED != 0) checked @endif>
                                                        @endif
                                                    </td>
                                                    <td
                                                        style="text-align: left; white-space: nowrap; vertical-align: middle;">
                                                        <small>
                                                            หมายเลข: {{ $query->Equip_SERIAL_NUMBER }} <br>
                                                            <textarea class="form-control mb-2" wire:model="Equip_NAME" type="text"></textarea>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">ราคาประเมินจริง</span>
                                                                <input class="form-control" min="1"
                                                                    wire:model="Equip_CURRENT_PRICE" type="number"
                                                                    placeholder="ราคา">
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-text">จำนวน</span>
                                                                <input class="form-control" min="1"
                                                                    wire:model="Equip_AMOUNT" type="number"
                                                                    placeholder="จำนวน">
                                                            </div>
                                                        </small>
                                                    </td>
                                                    <td style="text-align: center; white-space: nowrap;">
                                                        <select class="form-select" wire:model="Equip_STATUS">
                                                            <option value="" selected>เลือก</option>
                                                            @foreach ($EQUIPMENT_STATUS as $item)
                                                                <option value="{{ $item->STATUS_ID }}">
                                                                    {{ $item->STATUS_NAME }} </option>
                                                            @endforeach
                                                        </select>
                                                        <small>
                                                            {{ $query->Equip_STATUS_DATE }}
                                                        </small>
                                                    </td>
                                                    {{-- <td style="text-align: left; white-space: nowrap;">
                                                        <small>
                                                            แผนก: {{ $query->TCHN_LOCAT_NAME }}<br>
                                                            อายุการใช้งาน: {{ number_format($query->Equip_AGE) }}
                                                            ปี<br>
                                                            ราคาของวัสดุ: {{ number_format($query->Equip_PRICE) }} บาท
                                                        </small>
                                                    </td> --}}
                                                    <td
                                                        style="text-align: center; white-space: nowrap; vertical-align: middle;">
                                                        <button type="button"
                                                            wire:click="save_equip({{ $query->Equip_ID }})"
                                                            class="btn btn-outline-success btn-sm">บันทึก</button>
                                                        <a class="btn btn-outline-danger btn-sm"
                                                            href="http://192.168.2.142/PInsidewarehouse/detail?id={{ $Plan_ID }}">ยกเลิก</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        @if (count($EQUIPMENT_LIST) > 0)
                                            @foreach ($EQUIPMENT_LIST as $query)
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        @if ($query->Equip_CURRENT_PRICE == null)
                                                            <small style="color: red;">ใส่ราคา</small>
                                                        @else
                                                            <input class="form-check-input" type="checkbox"
                                                                wire:click="CheckedEquip({{ $query->Equip_ID }})"
                                                                @if ($query->Equip_USED != 0) checked @endif>
                                                        @endif
                                                    </td>
                                                    <td
                                                        style="text-align: left; white-space: nowrap; vertical-align: middle;">
                                                        <small>
                                                            หมายเลข: {{ $query->Equip_SERIAL_NUMBER }} <br>
                                                            ชื่อรายการ: {{ $query->Equip_NAME }} <br>
                                                            ราคาประเมินจริง:
                                                            {{ number_format(round($query->Equip_CURRENT_PRICE, 2), 2) }}
                                                            <br>
                                                            จำนวน:
                                                            {{ number_format(round($query->Equip_AMOUNT, 2), 0) }}
                                                        </small>
                                                    </td>
                                                    <td
                                                        style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                                        <small>{{ $query->STATUS_NAME }} <br>
                                                            {{ $query->Equip_STATUS_DATE }}</small>
                                                    </td>
                                                    {{-- <td style="text-align: left; white-space: nowrap; v">
                                                        <small>
                                                            แผนก: {{ $query->TCHN_LOCAT_NAME }}<br>
                                                            อายุการใช้งาน: {{ number_format($query->Equip_AGE) }}
                                                            ปี<br>
                                                            ราคาของวัสดุ: {{ number_format($query->Equip_PRICE) }} บาท
                                                        </small>
                                                    </td> --}}
                                                    <td
                                                        style="text-align: center; white-space: nowrap; vertical-align: middle;">
                                                        <button type="button"
                                                            wire:click="edit_equip({{ $query->Equip_ID }})"
                                                            class="btn btn-outline-danger btn-sm">แก้ไข</button>
                                                        <button type="button"
                                                            wire:click="deleteRow({{ $query->Equip_ID }})"
                                                            class="btn btn-outline-secondary btn-sm">ลบ</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"
                                                    style="text-align: center; vertical-align: middle;">
                                                    ยังไม่ได้เพิ่มข้อมูล
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                            {{ $EQUIPMENT_LIST->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function generatePdf(id) {
            // เช็คเงื่อนไขว่า $EQUIPMENT_PLAN->Total_Used เป็น 0 หรือไม่
            if ({{ $EQUIPMENT_PLAN->Plan_LEVEL }} == 2) {

                // แสดง Alert ให้ผู้ใช้เลือก
                toastr.error('เปลี่ยนแผนให้เป็นจริง โดยกดแก้ไขข้อมูล');
            } else if ({{ $EQUIPMENT_PLAN->Total_Current_Price }} == '.00') {


                // แสดง Alert ให้ผู้ใช้เลือก
                toastr.error('เพิ่มวัสดุก่อน จะสามารถกดแก้ไขและใส่ราคาได้');
            } else if ({{ $EQUIPMENT_PLAN->Checked_use }} == 0) {

                // แสดง Alert ให้ผู้ใช้เลือก
                toastr.error('เลือกรายการวัสดุ');
            } else {

                // เปิดหน้าต่างใหม่เพื่อสร้าง PDF
                window.open('/PInsidewarehousePDF/' + id, '_blank');

            }
        };

        window.addEventListener('CheckedEquip', event => {
            if (event.detail.refresh) {
                window.location.reload(); // รีเฟรชหน้า

            }
        });
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
                    const url = `http://192.168.2.142/replacement_plan/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });

        window.addEventListener('alert_maintenance_equip', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/maintenance_equip/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_repair_equip', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/repair_equip/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_contract_services', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/contract_services/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_calibration', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/calibration/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_potential_plan', event => {
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
        window.addEventListener('alert_replacement_plan', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/replacement_plan/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_noserial_plan', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/noserial_plan/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_outside', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/POutsidewarehouse/detail?id=${id}`;
                    window.location.href = url;
                }, 2000); // รอให้ progressBar จบเป็นเวลา 2 วินาที (2000 มิลลิวินาที)
            }
        });
        window.addEventListener('alert_inside', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                setTimeout(function() {
                    // รับค่าไอดีจาก URL โดยใช้ query string parameter
                    const id = event.detail.id ?? ''; // ถ้าไม่มีค่า id ให้กำหนดให้เป็นค่าว่าง
                    const url = `http://192.168.2.142/PInsidewarehouse/detail?id=${id}`;
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

        window.addEventListener('alert_delete', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            };
            if (event.detail.refresh) {
                window.location.reload(); // รีเฟรชหน้า

            }
        });
    </script>
</div>
