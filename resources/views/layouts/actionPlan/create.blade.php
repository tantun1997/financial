<div class="container-fluid px-4">
    @if ($planType == 'strategic')
        <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> สร้างแผนยุทธศาสตร์ ประจำปีงบประมาณ พ.ศ.
            {{ $year }}
        </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{ route('action_plan') }}">แผนปฏิบัติการ</a></li>
            <li class="breadcrumb-item active">
                สร้างแผนยุทธศาสตร์ ประจำปีงบประมาณ พ.ศ. {{ $year }}</li>
        </ol>
    @elseif($planType == 'regular')
        <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> สร้างแผนประจำ ประจำปีงบประมาณ พ.ศ. {{ $year }}
        </h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{ route('action_plan') }}">แผนปฏิบัติการ</a></li>
            <li class="breadcrumb-item active">
                สร้างแผนประจำ ประจำปีงบประมาณ พ.ศ. {{ $year }}</li>
        </ol>
    @endif


    <hr>


    @if ($goToCreatePage2)
        @if ($planType == 'strategic')
            <form wire:submit.prevent="confirmData()">
                @csrf
                @include('layouts.actionPlan.createPage2')
                <div style="text-align: left">
                    <input type="submit" class="btn btn-success" value="ยืนยันข้อมูล">
                </div>
            </form>
        @elseif($planType == 'regular')
            <form wire:submit.prevent="confirmData()">
                @csrf
                @include('layouts.actionPlan.createPage2')
                <div style="text-align: left">
                    <input type="submit" class="btn btn-success" value="ยืนยันข้อมูล">
                </div>
            </form>
        @endif
    @else
        @if ($planType == 'strategic')
            <form wire:submit.prevent="nextCreatePage2()">
                @csrf
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
                            <select class="form-select @error('M_ID') is-invalid @enderror" wire:model="M_ID"
                                id="M_ID" style="width: 50%;">
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
                                id="F_ID" style="width: 50%;">
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
                            <textarea class="form-control" wire:model="sub_kpi" id="sub_kpi" style="width: 50%;" col-md-3s="50"
                                rows="2" maxlength="250" autocomplete="off" placeholder="KPI ย่อย"></textarea>
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
        @elseif($planType == 'regular')
            <form wire:submit.prevent="nextCreatePage2()">
                @csrf
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
                                    style="margin-right: 5px;">กลุ่มภารกิจฯ/คณะกรรมการ:</b> <input
                                    class="form-control" type="text" wire:model="work_group" id="work_group"
                                    disabled>
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
                        <td><select class="form-select" wire:model="G_ID" id="G_ID" style="width: 50%;"
                                disabled>
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
                            <select class="form-select" wire:model="T_ID" id="T_ID" style="width: 50%;"
                                disabled>
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
                            <select class="form-select" wire:model="Indi_ID" id="Indi_ID" style="width: 50%;"
                                disabled>
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
                <div style="text-align: center">
                    <a class="btn btn-danger" href="{{ route('action_plan') }}" role="button">ยกเลิก</a>
                    <input type="submit" class="btn btn-success" value="ดำเนินการต่อไป">
                </div>
            </form>
        @endif

    @endif

    <script>
        document.addEventListener('livewire:load', function() {
            window.livewire.on('changeSI_ID', (SI_ID) => {
                @this.set('SI_ID', SI_ID);
            });

            window.livewire.on('changeG_ID', (G_ID) => {
                @this.set('G_ID', G_ID);
            });

            window.livewire.on('changeT_ID', (T_ID) => {
                @this.set('T_ID', T_ID);
            });

            window.livewire.on('changeIndi_ID', (Indi_ID) => {
                @this.set('Indi_ID', Indi_ID);
            });
        });

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
