<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> สร้างแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. {{ $year }}
    </h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('action_plan') }}">แผนปฏิบัติการ</a></li>
        <li class="breadcrumb-item active">
            สร้างแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. {{ $year }}</li>
    </ol>
    <hr>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if ($ACP_ProjectName_Main)
        <div style="display: flex; justify-content: space-between;">
            <a class="btn btn-outline-primary " href="{{ route('action_plan') }}">ย้อนกลับ</a>
            <button wire:click.prevent="editActionPlan({{ $ACP_ProjectName_Main->project_ID }})"
                class="btn btn-outline-danger">
                <i class="fa-solid fa-pen fa-xs"></i> แก้ไขข้อมูล
            </button>
        </div>
    @endif
    @if ($editID)
        @if ($planType == 'strategic')
            <div style="display: flex; justify-content: space-between;">
                <a class="btn btn-outline-primary "
                    href="{{ route('detail_action_plan', ['id' => $editID]) }}">ย้อนกลับ</a>
                <button wire:click.prevent="acceptActionPlan({{ $editID }})" class="btn btn-outline-danger">
                    <i class="fa-solid fa-pen fa-xs"></i> เรียบร้อย
                </button>
            </div>
            <table class="table table-bordered table-sm" style="width: 100%;">
                <tr>

                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">หน่วยงาน:</b>
                            <input class="form-control" type="text" wire:model="dept_name" id="dept_name" disabled>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">กลุ่มภารกิจฯ/คณะกรรมการ:</b> <input class="form-control"
                                type="text" wire:model="work_group" id="work_group" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">ชื่อโครงการ:</b>
                            <input class="form-control @error('project_name') is-invalid @enderror" type="text"
                                autocomplete="off" placeholder="ชื่อโครงการ" wire:model="project_name"
                                id="project_name">
                        </div>

                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">รวมงบประมาณ:</b>
                            <input class="form-control" type="number" autocomplete="off" placeholder="งบประมาณ"
                                wire:model="budget" id="budget" disabled>บาท
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table-sm" style="width: 100%;">
                <tr>
                    <th>พันธกิจ</th>
                    <td>
                        <select class="form-select @error('M_ID') is-invalid @enderror" wire:model="M_ID" id="M_ID"
                            style="width: 50%;">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Mission as $item)
                                <option value="{{ $item->M_Id }}">
                                    {{ $item->M_Name }} </option>
                            @endforeach
                        </select>
                        @error('M_ID')
                            <span class="text-danger error">โปรดเลือกพันธกิจ</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>เข็มมุ่ง</th>
                    <td>
                        <select class="form-select @error('F_ID') is-invalid @enderror" wire:model="F_ID" id="F_ID"
                            style="width: 50%;">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Focus as $item)
                                <option value="{{ $item->F_Id }}">
                                    {{ $item->F_Name }} </option>
                            @endforeach
                        </select>
                        @error('F_ID')
                            <span class="text-danger error">โปรดเลือกเข็มมุ่ง</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>ยุทธศาสตร์ </th>
                    <td>
                        <select class="form-select @error('SI_ID') is-invalid @enderror" wire:model="SI_ID"
                            id="SI_ID" style="width: 50%;">
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Strategy as $item)
                                <option value="{{ $item->SI_Id }}">
                                    {{ $item->SI_NAME_TH }} ({{ $item->SI_NAME_EN }}) </option>
                            @endforeach
                        </select>
                        @error('SI_ID')
                            <span class="text-danger error">โปรดเลือกยุทธศาสตร์</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th style="white-space: nowrap;">เป้าประสงค์เชิงยุทธศาสตร์ </th>
                    <td><select class="form-select" wire:model="G_ID" id="G_ID" style="width: 50%;">
                            <option value="" selected></option>
                            @foreach ($ACP_Goal as $item)
                                <option value="{{ $item->G_Id }}">
                                    {{ $item->G_NAME }} </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>กลยุทธ์</th>
                    <td>
                        <select class="form-select" wire:model="T_ID" id="T_ID" style="width: 50%;">
                            <option value="" selected></option>
                            @foreach ($ACP_Tactic as $item)
                                <option value="{{ $item->T_Id }}">
                                    {{ $item->T_Name }} </option>
                            @endforeach
                        </select>

                    </td>
                </tr>
                <tr>
                    <th>ตัวชี้วัดหลัก </th>
                    <td>
                        <select class="form-select" wire:model="Indi_ID" id="Indi_ID" style="width: 50%;">
                            <option value="" selected></option>
                            @foreach ($ACP_Indicators as $item)
                                <option value="{{ $item->Indi_Id }}">
                                    {{ $item->Indi_Name }} </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>KPI ย่อย</th>
                    <td>
                        <textarea class="form-control" wire:model="sub_kpi" id="sub_kpi" style="width: 50%;" col-md-3s="50" rows="2"
                            maxlength="250" autocomplete="off" placeholder="KPI ย่อย"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>วัตถุประสงค์โครงการ </th>
                    <td>
                        <textarea class="form-control @error('objective_project') is-invalid @enderror" wire:model="objective_project"
                            id="objective_project" style="width: 50%;" col-md-3s="50" rows="2" maxlength="250" autocomplete="off"
                            placeholder="วัตถุประสงค์โครงการ"></textarea>
                        @error('objective_project')
                            <span class="text-danger error">โปรดกรอกวัตถุประสงค์โครงการ</span>
                        @enderror
                    </td>
                </tr>
            </table>

            <div style="max-height: 100%; overflow-x: scroll; ">
                <table class="table-bordered table-sm" style="width: 100%;">
                    <thead>
                        <tr>
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
                        @foreach ($Edit_ACP_Project_Detail as $index => $item)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="P_Id.{{ $index }}"
                                        id="P_Id.{{ $index }}" style="width: 200px;" required>
                                        <option value="" selected>--------------</option>
                                        @foreach ($ACP_Plan as $item)
                                            <option value="{{ $item->P_Id }}">
                                                {{ $item->P_Name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 200px;"
                                        id="eventNActivity_name.{{ $index }}"
                                        wire:model="eventNActivity_name.{{ $index }}" required>
                                </td>
                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 150px;"
                                        id="groupTarget.{{ $index }}"
                                        wire:model="groupTarget.{{ $index }}" required>
                                </td>
                                <td style="text-align: center;"><input class="form-control " type="text"
                                        autocomplete="off" style="width: 100px;"
                                        id="amountTarget.{{ $index }}"
                                        wire:model="amountTarget.{{ $index }}" required>
                                </td>

                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 150px;" id="place.{{ $index }}"
                                        wire:model="place.{{ $index }}" required>
                                </td>

                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q1.{{ $index }}"
                                        style="width: 140px;" id="Q1.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q1 as $item)
                                            <option value="{{ $item->Q1_ID }}">
                                                {{ $item->Q1_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q2.{{ $index }}"
                                        style="width: 140px;" id="Q2.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q2 as $item)
                                            <option value="{{ $item->Q2_ID }}">
                                                {{ $item->Q2_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q3.{{ $index }}"
                                        style="width: 140px;" id="Q3.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q3 as $item)
                                            <option value="{{ $item->Q3_ID }}">
                                                {{ $item->Q3_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q4.{{ $index }}"
                                        style="width: 140px;" id="Q4.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q4 as $item)
                                            <option value="{{ $item->Q4_ID }}">
                                                {{ $item->Q4_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td style="text-align: center;"><input class="form-control" type="number"
                                        autocomplete="off" style="width: 140px;"
                                        id="budgetAmount.{{ $index }}"
                                        wire:model="budgetAmount.{{ $index }}" required>
                                </td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="BGS_Id.{{ $index }}"
                                        style="width: 140px;" id="BGS_Id.{{ $index }}" required>
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_BudgetSource as $item)
                                            <option value="{{ $item->BGS_Id }}">
                                                {{ $item->BGS_Name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 150px;"
                                        id="person_name.{{ $index }}"
                                        wire:model="person_name.{{ $index }}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary"
                    wire:click.prevent='addRow({{ $i }})'>+เพิ่ม</button>
            </div>
        @elseif ($planType == 'regular')
            <div style="display: flex; justify-content: space-between;">
                <a class="btn btn-outline-primary "
                    href="{{ route('detail_action_plan', ['id' => $editID]) }}">ย้อนกลับ</a>
                <button wire:click.prevent="acceptActionPlan({{ $editID }})" class="btn btn-outline-danger">
                    <i class="fa-solid fa-pen fa-xs"></i> เรียบร้อย
                </button>
            </div>
            <table class="table table-bordered table-sm" style="width: 100%;">
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">หน่วยงาน:</b>
                            <input class="form-control" type="text" wire:model="dept_name" id="dept_name"
                                disabled>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">กลุ่มภารกิจฯ/คณะกรรมการ:</b> <input class="form-control"
                                type="text" wire:model="work_group" id="work_group" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">ชื่อโครงการ:</b>
                            <input class="form-control @error('project_name') is-invalid @enderror" type="text"
                                autocomplete="off" placeholder="ชื่อโครงการ" wire:model="project_name"
                                id="project_name">
                        </div>

                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">รวมงบประมาณ:</b>
                            <input class="form-control @error('budget') is-invalid @enderror" type="number"
                                autocomplete="off" placeholder="งบประมาณ" wire:model="budget" id="budget"
                                disabled>บาท
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table-sm" style="width: 100%;">
                <tr>
                    <th>พันธกิจ</th>
                    <td>

                        <select class="form-select @error('M_ID') is-invalid @enderror" wire:model="M_ID"
                            id="M_ID" style="width: 50%;" disabled>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Mission as $item)
                                <option value="{{ $item->M_Id }}">
                                    {{ $item->M_Name }} </option>
                            @endforeach
                        </select>
                        @error('M_ID')
                            <span class="text-danger error">โปรดเลือกพันธกิจ</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>เข็มมุ่ง</th>
                    <td>
                        <select class="form-select @error('F_ID') is-invalid @enderror" wire:model="F_ID"
                            id="F_ID" style="width: 50%;" disabled>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Focus as $item)
                                <option value="{{ $item->F_Id }}">
                                    {{ $item->F_Name }} </option>
                            @endforeach
                        </select>
                        @error('F_ID')
                            <span class="text-danger error">โปรดเลือกเข็มมุ่ง</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>ยุทธศาสตร์ </th>
                    <td>
                        <select class="form-select @error('SI_ID') is-invalid @enderror" wire:model="SI_ID"
                            id="SI_ID" style="width: 50%;" disabled>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Strategy as $item)
                                <option value="{{ $item->SI_Id }}">
                                    {{ $item->SI_NAME_TH }} ({{ $item->SI_NAME_EN }}) </option>
                            @endforeach
                        </select>
                        @error('SI_ID')
                            <span class="text-danger error">โปรดเลือกยุทธศาสตร์</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th style="white-space: nowrap;">เป้าประสงค์เชิงยุทธศาสตร์ </th>
                    <td><select class="form-select @error('G_ID') is-invalid @enderror" wire:model="G_ID"
                            id="G_ID" style="width: 50%;" disabled>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Goal as $item)
                                <option value="{{ $item->G_Id }}">
                                    {{ $item->G_NAME }} </option>
                            @endforeach
                        </select>
                        @error('G_ID')
                            <span class="text-danger error">โปรดเลือกเป้าประสงค์เชิงยุทธศาสตร์</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>กลยุทธ์</th>
                    <td>
                        <select class="form-select @error('T_ID') is-invalid @enderror" wire:model="T_ID"
                            id="T_ID" style="width: 50%;" disabled>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Tactic as $item)
                                <option value="{{ $item->T_Id }}">
                                    {{ $item->T_Name }} </option>
                            @endforeach
                        </select>
                        @error('T_ID')
                            <span class="text-danger error">โปรดเลือกกลยุทธ์</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>ตัวชี้วัดหลัก </th>
                    <td>
                        <select class="form-select  @error('Indi_ID') is-invalid @enderror" wire:model="Indi_ID"
                            id="Indi_ID" style="width: 50%;" disabled>
                            <option value="" selected>เลือก</option>
                            <option value="" disabled>-------------------------</option>
                            @foreach ($ACP_Indicators as $item)
                                <option value="{{ $item->Indi_Id }}">
                                    {{ $item->Indi_Name }} </option>
                            @endforeach
                        </select>
                        @error('Indi_ID')
                            <span class="text-danger error">โปรดเลือกตัวชี้วัดหลัก</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>KPI ย่อย</th>
                    <td>
                        <textarea class="form-control" wire:model="sub_kpi" id="sub_kpi" style="width: 50%;" col-md-3s="50"
                            rows="2" maxlength="250" autocomplete="off" placeholder="KPI ย่อย" disabled></textarea>
                    </td>
                </tr>
                <tr>
                    <th>วัตถุประสงค์โครงการ </th>
                    <td>
                        <textarea class="form-control @error('objective_project') is-invalid @enderror" wire:model="objective_project"
                            id="objective_project" style="width: 50%;" col-md-3s="50" rows="2" maxlength="250" autocomplete="off"
                            placeholder="วัตถุประสงค์โครงการ" disabled></textarea>
                        @error('objective_project')
                            <span class="text-danger error">โปรดกรอกวัตถุประสงค์โครงการ</span>
                        @enderror
                    </td>
                </tr>
            </table>
            <div style="max-height: 100%; overflow-x: scroll; ">
                <table class="table-bordered table-sm" style="width: 100%;">
                    <thead>
                        <tr>
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
                        @foreach ($Edit_ACP_Project_Detail as $index => $item)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="P_Id.{{ $index }}"
                                        id="P_Id.{{ $index }}" style="width: 200px;" required>
                                        <option value="" selected>--------------</option>
                                        @foreach ($ACP_Plan as $item)
                                            <option value="{{ $item->P_Id }}">
                                                {{ $item->P_Name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 200px;"
                                        id="eventNActivity_name.{{ $index }}"
                                        wire:model="eventNActivity_name.{{ $index }}" required>
                                </td>
                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 150px;"
                                        id="groupTarget.{{ $index }}"
                                        wire:model="groupTarget.{{ $index }}" required>
                                </td>
                                <td style="text-align: center;"><input class="form-control " type="text"
                                        autocomplete="off" style="width: 100px;"
                                        id="amountTarget.{{ $index }}"
                                        wire:model="amountTarget.{{ $index }}" required>
                                </td>

                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 150px;" id="place.{{ $index }}"
                                        wire:model="place.{{ $index }}" required>
                                </td>

                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q1.{{ $index }}"
                                        style="width: 140px;" id="Q1.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q1 as $item)
                                            <option value="{{ $item->Q1_ID }}">
                                                {{ $item->Q1_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q2.{{ $index }}"
                                        style="width: 140px;" id="Q2.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q2 as $item)
                                            <option value="{{ $item->Q2_ID }}">
                                                {{ $item->Q2_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q3.{{ $index }}"
                                        style="width: 140px;" id="Q3.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q3 as $item)
                                            <option value="{{ $item->Q3_ID }}">
                                                {{ $item->Q3_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="Q4.{{ $index }}"
                                        style="width: 140px;" id="Q4.{{ $index }}">
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_Q4 as $item)
                                            <option value="{{ $item->Q4_ID }}">
                                                {{ $item->Q4_NAME }} </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td style="text-align: center;"><input class="form-control" type="number"
                                        autocomplete="off" style="width: 140px;"
                                        id="budgetAmount.{{ $index }}"
                                        wire:model="budgetAmount.{{ $index }}" required>
                                </td>
                                <td style="text-align: center;">
                                    <select class="form-select" wire:model="BGS_Id.{{ $index }}"
                                        style="width: 140px;" id="BGS_Id.{{ $index }}" required>
                                        <option value="" selected>-------------------------</option>
                                        @foreach ($ACP_BudgetSource as $item)
                                            <option value="{{ $item->BGS_Id }}">
                                                {{ $item->BGS_Name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align: center;"><input class="form-control" type="text"
                                        autocomplete="off" style="width: 150px;"
                                        id="person_name.{{ $index }}"
                                        wire:model="person_name.{{ $index }}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary"
                    wire:click.prevent='addRow({{ $i }})'>+เพิ่ม</button>
            </div>
        @endif
    @else
        @if ($ACP_ProjectName_Main->planType == 'strategic')
            <table class="table table-bordered table-sm" style="width: 100%;">
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">หน่วยงาน:</b> {{ $ACP_ProjectName_Main->dept_name }}</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">กลุ่มภารกิจฯ/คณะกรรมการ:</b>
                            {{ $ACP_ProjectName_Main->work_group }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">ชื่อโครงการ:</b>
                            {{ $ACP_ProjectName_Main->project_name }}
                        </div>

                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">รวมงบประมาณ:</b>
                            {{ number_format($ACP_ProjectName_Main->budget) }} บาท

                        </div>
                    </td>
                </tr>
            </table>
            <table class="table" style="width: 100%;">
                <tr>
                    <th>พันธกิจ</th>
                    <td>
                        {{ $ACP_ProjectName_Main->M_Name }}
                    </td>
                </tr>
                <tr>
                    <th>เข็มมุ่ง</th>
                    <td>
                        {{ $ACP_ProjectName_Main->F_Name }}

                    </td>
                </tr>
                <tr>
                    <th>ยุทธศาสตร์ </th>
                    <td>
                        {{ $ACP_ProjectName_Main->SI_NAME_TH }} ({{ $ACP_ProjectName_Main->SI_NAME_EN }})
                    </td>
                </tr>
                <tr>
                    <th style="white-space: nowrap;">เป้าประสงค์เชิงยุทธศาสตร์ </th>
                    <td> {{ $ACP_ProjectName_Main->G_NAME }}</td>
                </tr>
                <tr>
                    <th>กลยุทธ์</th>
                    <td>
                        {{ $ACP_ProjectName_Main->T_Name }}
                    </td>
                </tr>
                <tr>
                    <th>ตัวชี้วัดหลัก </th>
                    <td>
                        {{ $ACP_ProjectName_Main->Indi_Name }}

                    </td>
                </tr>
                <tr>
                    <th>KPI ย่อย</th>
                    <td>
                        {{ $ACP_ProjectName_Main->sub_kpi }}

                    </td>
                </tr>
                <tr>
                    <th>วัตถุประสงค์โครงการ </th>
                    <td>
                        {{ $ACP_ProjectName_Main->objective_project }}
                    </td>
                </tr>
            </table>
            <div>
                <table class="table-bordered table-sm" style="width: 100%; ">
                    <thead>
                        <tr>
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
                        @foreach ($VW_ACP_Project_Detail as $item)
                            <tr>
                                <td style="text-align: center;"> {{ $item->index }}
                                </td>
                                <td style="text-align: center;">
                                    {{ $item->P_Name }}
                                </td>
                                <td style="text-align: center;"> {{ $item->eventNActivity_name }}
                                </td>
                                <td style="text-align: center;"> {{ $item->groupTarget }}
                                </td>
                                <td style="text-align: center;"> {{ $item->amountTarget }}
                                </td>
                                <td style="text-align: center;"> {{ $item->place }}
                                </td>
                                <td style="text-align: center; white-space: nowrap;">{{ $item->Q1_NAME }}</td>
                                <td style="text-align: center; white-space: nowrap;">{{ $item->Q2_NAME }}</td>
                                <td style="text-align: center; white-space: nowrap;"> {{ $item->Q3_NAME }}</td>
                                <td style="text-align: center; white-space: nowrap;"> {{ $item->Q4_NAME }} </td>
                                <td style="text-align: center;"> {{ number_format($item->budgetAmount) }}</td>
                                <td style="text-align: center; white-space: nowrap;"> {{ $item->BGS_Name }}</select>
                                </td>
                                <td style="text-align: center;"> {{ $item->person_name }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($ACP_ProjectName_Main->planType == 'regular')
            <table class="table table-bordered table-sm" style="width: 100%;">
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">หน่วยงาน:</b> {{ $ACP_ProjectName_Main->dept_name }}</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">กลุ่มภารกิจฯ/คณะกรรมการ:</b>
                            {{ $ACP_ProjectName_Main->work_group }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">ชื่อโครงการ:</b>
                            {{ $ACP_ProjectName_Main->project_name }}
                        </div>

                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;">
                            <b style="margin-right: 5px;">รวมงบประมาณ:</b>
                            {{ number_format($ACP_ProjectName_Main->budget) }} บาท

                        </div>
                    </td>
                </tr>
            </table>
            <table class="table" style="width: 100%;">
                <tr>
                    <th>พันธกิจ</th>
                    <td>
                        {{ $ACP_ProjectName_Main->M_Name }}
                    </td>
                </tr>
                <tr>
                    <th>เข็มมุ่ง</th>
                    <td>
                        {{ $ACP_ProjectName_Main->F_Name }}

                    </td>
                </tr>
                <tr>
                    <th>ยุทธศาสตร์ </th>
                    <td>
                        {{ $ACP_ProjectName_Main->SI_NAME_TH }} {{ $ACP_ProjectName_Main->SI_NAME_EN }}
                    </td>
                </tr>
                <tr>
                    <th style="white-space: nowrap;">เป้าประสงค์เชิงยุทธศาสตร์ </th>
                    <td> {{ $ACP_ProjectName_Main->G_NAME }}</td>
                </tr>
                <tr>
                    <th>กลยุทธ์</th>
                    <td>
                        {{ $ACP_ProjectName_Main->T_Name }}
                    </td>
                </tr>
                <tr>
                    <th>ตัวชี้วัดหลัก </th>
                    <td>
                        {{ $ACP_ProjectName_Main->Indi_Name }}

                    </td>
                </tr>
                <tr>
                    <th>KPI ย่อย</th>
                    <td>
                        {{ $ACP_ProjectName_Main->sub_kpi }}

                    </td>
                </tr>
                <tr>
                    <th>วัตถุประสงค์โครงการ </th>
                    <td>
                        {{ $ACP_ProjectName_Main->objective_project }}
                    </td>
                </tr>
            </table>
            <div>
                <table class="table-bordered table-sm" style="width: 100%; ">
                    <thead>
                        <tr>
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
                        @foreach ($VW_ACP_Project_Detail as $item)
                            <tr>
                                <td style="text-align: center;"> {{ $item->index }}
                                </td>
                                <td style="text-align: center;">
                                    {{ $item->P_Name }}
                                </td>
                                <td style="text-align: center;"> {{ $item->eventNActivity_name }}
                                </td>
                                <td style="text-align: center;"> {{ $item->groupTarget }}
                                </td>
                                <td style="text-align: center;"> {{ $item->amountTarget }}
                                </td>
                                <td style="text-align: center;"> {{ $item->place }}
                                </td>
                                <td style="text-align: center; white-space: nowrap;">{{ $item->Q1_NAME }}</td>
                                <td style="text-align: center; white-space: nowrap;">{{ $item->Q2_NAME }}</td>
                                <td style="text-align: center; white-space: nowrap;"> {{ $item->Q3_NAME }}</td>
                                <td style="text-align: center; white-space: nowrap;"> {{ $item->Q4_NAME }} </td>
                                <td style="text-align: center;"> {{ number_format($item->budgetAmount) }}</td>
                                <td style="text-align: center; white-space: nowrap;"> {{ $item->BGS_Name }}</select>
                                </td>
                                <td style="text-align: center;"> {{ $item->person_name }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif




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
