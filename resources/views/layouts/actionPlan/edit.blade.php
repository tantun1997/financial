<div class="container-fluid px-4">
    <h3 class="mt-3 mb-3"><i class="fa-solid fa-inbox "></i> สร้างแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. {{ $year }}
    </h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item "><a href="{{ route('action_plan') }}">แผนปฏิบัติการ</a></li>
        <li class="breadcrumb-item active">
            สร้างแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ. {{ $year }}</li>
    </ol>
    <hr>
    <table class="table-bordered table-sm" style="width: 100%;">
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
                    {{ $ACP_ProjectName_Main->project_name }}
                </div>

            </td>
            <td>
                <div style="display: flex; align-items: center; white-space: nowrap;">
                    <b style="margin-right: 5px;">รวมงบประมาณ:</b>
                    {{ $ACP_ProjectName_Main->budget }}

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
            <td> {{ $ACP_ProjectName_Main->G_NAME }}

            </td>
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
    <div style="max-height: 100%; overflow-x: scroll; ">
        <input type="hidden" wire:model="project_ID">
        <table class="table-bordered table-sm" style="width: 100%; ">
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
                @foreach ($VW_ACP_Project_Detail as $item)
                    <tr>
                        <td style="text-align: center;"> {{ $item->id }}
                        </td>
                        <td style="text-align: center;"> {{ $item->eventNActivity_name }}
                        </td>
                        <td style="text-align: center;"> {{ $item->groupTarget }}
                        </td>
                        <td style="text-align: center;"> {{ $item->amountTarget }}
                        </td>
                        <td style="text-align: center;"> {{ $item->place }}
                        </td>
                        <td style="text-align: center;">{{ $item->Q1 }}</td>
                        <td style="text-align: center;">{{ $item->Q2 }}</td>
                        <td style="text-align: center;"> {{ $item->Q3 }}</td>
                        <td style="text-align: center;"> {{ $item->Q4 }} </td>
                        <td style="text-align: center;"> {{ number_format($item->budgetAmount) }}</td>
                        <td style="text-align: center;"> {{ $item->BGS_Name }}</select></td>
                        <td style="text-align: center;"> {{ $item->person_name }}</td>
                        <td style="text-align: center;">
                            {{ $item->P_Name }}
                        </td>
                        <td style="text-align: center;">
                            {{-- <button class="btn btn-danger btn-sm"
                            wire:click.prevent='removeRow({{ $index }})'>-ลบ</button> --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <button type="button" class="btn btn-primary" wire:click.prevent='addRow({{ $i }})'>+เพิ่ม</button>
    </div>



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
