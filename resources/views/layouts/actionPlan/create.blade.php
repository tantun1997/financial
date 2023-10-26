<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> สร้างแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. 2567</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('action_plan') }}">แผนปฏิบัติการ</a></li>
        <li class="breadcrumb-item active">
            สร้างแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. 2567</li>
    </ol>
    <hr>

    @if ($goToCreatePage2)
        @include('layouts.actionPlan.createPage2')
    @else
        <form wire:submit.prevent="nextCreatePage2()">
            @csrf
            <table class="table table-bordered table-sm" style="width: 100%;">
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">หน่วยงาน:</b> {{ Auth::user()->deptName }}</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; white-space: nowrap;"><b
                                style="margin-right: 5px;">กลุ่มภารกิจฯ/คณะกรรมการ:</b> -</div>
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
                                autocomplete="off" placeholder="งบประมาณ" wire:model="budget" id="budget">บาท
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
                    <td><select class="form-select @error('G_ID') is-invalid @enderror" wire:model="G_ID" id="G_ID"
                            style="width: 50%;">
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
                        <select class="form-select @error('T_ID') is-invalid @enderror" wire:model="T_ID" id="T_ID"
                            style="width: 50%;">
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
                            id="Indi_ID" style="width: 50%;">
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
            <div style="text-align: center">
                <a class="btn btn-danger" href="{{ route('action_plan') }}" role="button">ยกเลิก</a>
                <input type="submit" class="btn btn-success" value="ดำเนินการต่อไป">
            </div>
        </form>
    @endif
    {{-- <div style="max-height: 100%; overflow-x: scroll; ">
        <form wire:submit.prevent="confirmData()">
            @csrf
            <input type="hidden" wire:model="project_ID">
            <table class="table table-bordered table-sm" style="width: 100%; ">
                <thead>
                    <tr>
                        <th style="text-align: center;">ลำดับ</th>
                        <th style="text-align: center;">งานและกิจกรรม</th>
                        <th colspan="2" style="text-align: center;">กลุ่มเป้าหมายของงานและกิจกรรม</th>
                        <th style="text-align: center; white-space: nowrap;">สถานที่ดำเนินการ</th>
                        <th colspan="4" style="text-align: center;">ระยะเวลาดำเนินการ</th>
                        <th colspan="2" style="text-align: center;">งบประมาณ</th>
                        <th style="text-align: center; white-space: nowrap;">ผู้รับผิดชอบ</th>
                        <th style="text-align: center; white-space: nowrap;">แผนที่เกี่ยวข้อง</th>
                    </tr>
                    <tr>
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
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $index => $value)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td style="text-align: center;"><input
                                    class="form-control @error('eventNActivity_name.' . $value) is-invalid @enderror"
                                    type="text" autocomplete="off" style="width: 200px;"
                                    id="eventNActivity_name.{{ $value }}"
                                    wire:model="eventNActivity_name.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input
                                    class="form-control @error('groupTarget.' . $value) is-invalid @enderror"
                                    type="text" autocomplete="off" style="width: 150px;"
                                    id="groupTarget.{{ $value }}"
                                    wire:model="groupTarget.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input
                                    class="form-control @error('amountTarget.' . $value) is-invalid @enderror"
                                    type="text" autocomplete="off" style="width: 100px;"
                                    id="amountTarget.{{ $value }}"
                                    wire:model="amountTarget.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input
                                    class="form-control @error('place.' . $value) is-invalid @enderror"
                                    type="text" autocomplete="off" style="width: 150px;"
                                    id="place.{{ $value }}" wire:model="place.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input class="form-control" type="text"
                                    autocomplete="off" style="width: 120px;" id="Q1.{{ $value }}"
                                    wire:model="Q1.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input class="form-control" type="text"
                                    autocomplete="off" style="width: 120px;" id="Q2.{{ $value }}"
                                    wire:model="Q2.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input class="form-control" type="text"
                                    autocomplete="off" style="width: 120px;" id="Q3.{{ $value }}"
                                    wire:model="Q3.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input class="form-control" type="text"
                                    autocomplete="off" style="width: 120px;" id="Q4.{{ $value }}"
                                    wire:model="Q4.{{ $value }}">
                            </td>
                            <td style="text-align: center;"><input
                                    class="form-control @error('budgetAmount.' . $value) is-invalid @enderror"
                                    type="number" autocomplete="off" style="width: 140px;"
                                    id="budgetAmount.{{ $value }}"
                                    wire:model="budgetAmount.{{ $value }}">
                            </td>
                            <td style="text-align: center;"> <select
                                    class="form-select  @error('BGS_Id.' . $value) is-invalid @enderror"
                                    wire:model="BGS_Id.{{ $value }}" style="width: 140px;"
                                    id="BGS_Id.{{ $value }}">
                                    <option value="" selected>เลือก</option>
                                    <option value="" disabled>-------------------------</option>
                                    @foreach ($ACP_BudgetSource as $item)
                                        <option value="{{ $item->BGS_Id }}">
                                            {{ $item->BGS_Name }} </option>
                                    @endforeach
                                </select></td>
                            <td style="text-align: center;"><input
                                    class="form-control  @error('person_name.' . $value) is-invalid @enderror"
                                    type="text" autocomplete="off" style="width: 150px;"
                                    id="person_name.{{ $value }}"
                                    wire:model="person_name.{{ $value }}">
                            </td>
                            <td style="text-align: center;">
                                <select class="form-select @error('P_Id.' . $value) is-invalid @enderror"
                                    wire:model="P_Id.{{ $value }}" id="P_Id.{{ $value }}"
                                    style="width: 200px;">
                                    <option value="" selected>เลือก</option>
                                    <option value="" disabled>-------------------------</option>
                                    @foreach ($ACP_Plan as $item)
                                        <option value="{{ $item->P_Id }}">
                                            {{ $item->P_Name }} </option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-danger btn-sm"
                                    wire:click.prevent='removeRow({{ $index }})'>-ลบ</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <button type="button" class="btn btn-primary"
                wire:click.prevent='addRow({{ $i }})'>+เพิ่ม</button>

            <div style="text-align: center">
                <input type="submit" class="btn btn-success" value="ยืนยันข้อมูล">
            </div>
        </form>
    </div> --}}



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
