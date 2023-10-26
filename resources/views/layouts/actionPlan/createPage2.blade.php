 <div>
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
                                 id="groupTarget.{{ $value }}" wire:model="groupTarget.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input
                                 class="form-control @error('amountTarget.' . $value) is-invalid @enderror"
                                 type="text" autocomplete="off" style="width: 100px;"
                                 id="amountTarget.{{ $value }}" wire:model="amountTarget.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input
                                 class="form-control @error('place.' . $value) is-invalid @enderror" type="text"
                                 autocomplete="off" style="width: 150px;" id="place.{{ $value }}"
                                 wire:model="place.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                                 style="width: 120px;" id="Q1.{{ $value }}" wire:model="Q1.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                                 style="width: 120px;" id="Q2.{{ $value }}"
                                 wire:model="Q2.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                                 style="width: 120px;" id="Q3.{{ $value }}"
                                 wire:model="Q3.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input class="form-control" type="text" autocomplete="off"
                                 style="width: 120px;" id="Q4.{{ $value }}"
                                 wire:model="Q4.{{ $value }}">
                         </td>
                         <td style="text-align: center;"><input
                                 class="form-control @error('budgetAmount.' . $value) is-invalid @enderror"
                                 type="number" autocomplete="off" style="width: 140px;"
                                 id="budgetAmount.{{ $value }}" wire:model="budgetAmount.{{ $value }}">
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
                                 id="person_name.{{ $value }}" wire:model="person_name.{{ $value }}">
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
 </div>
