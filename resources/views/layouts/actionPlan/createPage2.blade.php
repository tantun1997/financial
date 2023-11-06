<div style="max-height: 100%; overflow-x: scroll; ">
    <input type="hidden" wire:model="project_ID">
    <table class="table-bordered table-sm" style="width: 100%; ">
        <thead>
            <tr>
                <th style="text-align: center;">-</th>
                <th style="text-align: center;">ลำดับ</th>
                <th style="text-align: center; white-space: nowrap;">แผนที่เกี่ยวข้อง</th>
                <th style="text-align: center;">งานและกิจกรรม</th>
                <th colspan="2" style="text-align: center;">กลุ่มเป้าหมายของงานและกิจกรรม</th>
                <th style="text-align: center; white-space: nowrap;">สถานที่ดำเนินการ</th>
                <th colspan="4" style="text-align: center;">ระยะเวลาดำเนินการ</th>
                <th colspan="2" style="text-align: center;">งบประมาณ</th>
                <th style="text-align: center; white-space: nowrap;">ผู้รับผิดชอบ</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th style="text-align: center;">กลุ่ม</th>
                <th style="text-align: center;">จำนวน(หน่วย)</th>
                <td></td>
                <th style="text-align: center;">Q1</th>
                <th style="text-align: center;">Q2</th>
                <th style="text-align: center;">Q3</th>
                <th style="text-align: center;">Q4</th>
                <th style="text-align: center;">จำนวน(บาท)</th>
                <th style="text-align: center; white-space: nowrap;">แหล่งงบประมาณ</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $value)
                <tr>
                    <td style="text-align: center;">
                        <button type="button" wire:click.prevent="removeRow({{ $index }})"
                            class="btn btn-outline-danger btn-sm">ลบ</button>
                    </td>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">
                        <select class="form-select" wire:model="P_Id.{{ $value }}" id="P_Id.{{ $value }}"
                            style="width: 200px;" required>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Plan as $item)
                                <option value="{{ $item->P_Id }}">
                                    {{ $item->P_Name }} </option>
                            @endforeach
                        </select>
                    </td>
                    <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                            style="width: 200px;" id="eventNActivity_name.{{ $value }}"
                            wire:model="eventNActivity_name.{{ $value }}" required>
                    </td>
                    <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                            style="width: 150px;" id="groupTarget.{{ $value }}"
                            wire:model="groupTarget.{{ $value }}" required>
                    </td>
                    <td style="text-align: center;"><input class="form-control " type="text" autocomplete="off"
                            style="width: 100px;" id="amountTarget.{{ $value }}"
                            wire:model="amountTarget.{{ $value }}" required>
                    </td>

                    <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                            style="width: 150px;" id="place.{{ $value }}"
                            wire:model="place.{{ $value }}" required>
                    </td>
                    <td style="text-align: center;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" wire:model="Q1.{{ $value }}.1"
                                value="1">
                            <label class="form-check-label">ต.ค.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q1.{{ $value }}.2"
                                value="2">
                            <label class="form-check-label">พ.ย.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q1.{{ $value }}.3"
                                value="3">
                            <label class="form-check-label">ธ.ค.</label>
                        </div>
                    </td>

                    <td style="text-align: center;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" wire:model="Q2.{{ $value }}.1"
                                value="1">
                            <label class="form-check-label">ม.ค.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q2.{{ $value }}.2"
                                value="2">
                            <label class="form-check-label">ก.พ.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q2.{{ $value }}.3"
                                value="3">
                            <label class="form-check-label">มี.ค.</label>
                        </div>
                    </td>

                    <td style="text-align: center;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" wire:model="Q3.{{ $value }}.1"
                                value="1">
                            <label class="form-check-label">เม.ย.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q3.{{ $value }}.2"
                                value="2">
                            <label class="form-check-label">พ.ค.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q3.{{ $value }}.3"
                                value="3">
                            <label class="form-check-label">มิ.ย.</label>
                        </div>
                    </td>

                    <td style="text-align: center;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" wire:model="Q4.{{ $value }}.1"
                                value="1">
                            <label class="form-check-label">ก.ค.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q4.{{ $value }}.2"
                                value="2">
                            <label class="form-check-label">ส.ค.</label><br>
                            <input class="form-check-input" type="checkbox" wire:model="Q4.{{ $value }}.3"
                                value="3">
                            <label class="form-check-label">ก.ย.</label>
                        </div>
                    </td>

                    <td style="text-align: center;"><input class="form-control" type="number" min="1"
                            autocomplete="off" style="width: 140px;" id="budgetAmount.{{ $value }}"
                            wire:model="budgetAmount.{{ $value }}" required>
                    </td>
                    <td style="text-align: center;">
                        <select class="form-select" wire:model="BGS_Id.{{ $value }}" style="width: 140px;"
                            id="BGS_Id.{{ $value }}" required>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_BudgetSource as $item)
                                <option value="{{ $item->BGS_Id }}">
                                    {{ $item->BGS_Name }} </option>
                            @endforeach
                        </select>
                    </td>
                    <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                            style="width: 150px;" id="person_name.{{ $value }}"
                            wire:model="person_name.{{ $value }}" required>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" wire:click.prevent='addRow({{ $i }})'>เพิ่ม</button>
</div>
<br>
