<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    เพิ่มแผนฯสอบเทียบเครื่องมือ
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="store()">
                @csrf
                <div class="modal-header" style="background-color: rgb(189, 226, 172)">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black"><i class="fa-solid fa-inbox fa-lg"></i>
                        เพิ่มแผนฯสอบเทียบเครื่องมือ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <span id="budget"><i class="fa-solid fa-calendar-days fa-sm"></i> ปีงบประมาณ</span>
                            <select class="form-select @error('budget') is-invalid @enderror" wire:model.defer="budget"
                                id="budget" style="width: 100%;" aria-labelledby="budget">
                                @php
                                    $currentYear = date('Y');
                                    $nextYear = $currentYear + 1;
                                    $displayedNextYear = $nextYear + 543;
                                @endphp
                                <option value="{{ $nextYear + 543 }}">{{ $displayedNextYear }}</option>
                                <option value="{{ $currentYear + 543 }}">{{ $currentYear + 543 }}</option>
                            </select>
                            @error('year')
                                <span class="text-danger error">โปรดเลือกปีงบประมาณ</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="priorityNo"><i class="fa-solid fa-paperclip fa-sm"></i>
                                ลำดับความสำคัญ</span>
                            <input class="form-control @error('priorityNo') is-invalid @enderror"
                                wire:model.defer="priorityNo" id="priorityNo" type="text" maxlength="3"
                                style="width: 100%;" autocomplete="off" aria-labelledby="priorityNo">
                            @error('priorityNo')
                                <span class="text-danger error">โปรดใส่ลำดับความสำคัญ ใส่ได้เฉพาะตัวเลข</span>
                            @enderror
                        </div>
                       <div class="col-md-3">
                            <span id="levelNo">แผนฯ</span>
                            <select class="form-select @error('levelNo') is-invalid @enderror"
                                wire:model.defer="levelNo" id="levelNo" style="width: 100%;"
                                aria-labelledby="levelNo">
                                <option value="" selected>เลือก</option>
                                <option value="" disabled>-------------------------</option>
                                <option value="1">จริง</option>
                                <option value="2">สำรอง</option>
                            </select>
                            @error('levelNo')
                                <span class="text-danger error">โปรดเลือกแผนฯ</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="objectTypeId"><i class="fa-light fa-list fa-sm"></i> ประเภท</span>
                            <select class="form-select @error('objectTypeId') is-invalid @enderror"
                                wire:model.defer="objectTypeId" id="objectTypeId" style="width: 100%;"
                                aria-labelledby="objectTypeId">
                                <option value="" selected>เลือก</option>
                                <option value="" disabled>-------------------------</option>
                                @foreach ($procurement_object as $object)
                                    <option value="{{ $object->procurementCode }}">
                                        {{ $object->objectName }} </option>
                                @endforeach
                            </select>
                            @error('objectTypeId')
                                <span class="text-danger error">โปรดเลือกประเภท</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <span id="description"><i class="fa-solid fa-clipboard-list fa-sm"></i> ชื่อรายการ</span>
                            <input class="form-control @error('description') is-invalid @enderror" type="text"
                                wire:model.defer="description" id="description" list="listDescription"
                                autocomplete="off" style="width: 100%;" placeholder="ชื่อรายการ"
                                aria-labelledby="description" wire:change="updateFieldsFromDescription">
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
                                            @if ($plan->procurementType == '2' && !in_array($plan->objectTypeId, $usedNames))
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
                                <span class="text-danger error">โปรดเลือกชื่อรายการ</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="price"><i class="fa-duotone fa-coins fa-sm"></i> ราคาต่อหน่วย</span>
                            <input class="form-control @error('price') is-invalid @enderror" min="1"
                                wire:model.defer="price" id="price" type="number" style="width: 100%;"
                                autocomplete="off" placeholder="ราคาต่อหน่วย" aria-labelledby="price">
                            @error('price')
                                <span class="text-danger error">โปรดใส่ราคาต่อหน่วย</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="quant"><i class="fa-solid fa-tag fa-sm"></i> จำนวน</span>
                            <input class="form-control @error('quant') is-invalid @enderror" wire:model.defer="quant"
                                min="1" id="quant" type="number" style="width: 100%;"
                                autocomplete="off" aria-labelledby="quant">
                            @error('quant')
                                <span class="text-danger error">โปรดใส่จำนวน</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="package"><i class="fa-solid fa-tag fa-sm"></i> ชื่อหน่วยนับ</span>
                            <input class="form-control @error('package') is-invalid @enderror"
                                wire:model.defer="package" id="package" type="text" style="width: 100%;"
                                maxlength="250" autocomplete="off" placeholder="หน่วย" aria-labelledby="package">
                            @error('package')
                                <span class="text-danger error">โปรดใส่ชื่อหน่วยนับและห้ามใส่ตัวเลข</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="reason"><i class="fa-regular fa-comment fa-sm"></i>
                                เหตุผลและความจำเป็น</span>
                            <textarea class="form-control @error('reason') is-invalid @enderror" wire:model.defer="reason" id="reason"
                                style="width: 100%;" col-md-3s="50" rows="2" maxlength="250" autocomplete="off"
                                placeholder="เหตุผลและความจำเป็น" aria-labelledby="reason"></textarea>
                            @error('reason')
                                <span class="text-danger error">โปรดพิมพ์เหตุผลและความจำเป็น</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="remark"><i class="fa-solid fa-quote-left fa-sm"></i> หมายเหตุ</span>
                            <input class="form-control" wire:model.defer="remark" id="remark" type="text"
                                style="width: 100%;" maxlength="250" autocomplete="off"
                                placeholder="หมายเหตุ(ถ้ามี)" aria-labelledby="remark">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="closeModal">ปิด</button>
                    <button type="button" wire:click.prevent="resetFields()" class="btn btn-danger">รีเซ็ต</button>
                    <input type="submit" class="btn btn-success" value="เพิ่มข้อมูล">
                </div>
            </form>
        </div>
    </div>
</div>
