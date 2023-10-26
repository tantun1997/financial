<div wire:ignore.self class="modal fade" id="exampleModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="update()">
                @csrf
                <div class="modal-header" style="background-color: rgb(236, 134, 120)">
                    <h5 class="modal-title" id="exampleModal1Label" style="color: black"><i
                            class="fa-solid fa-screwdriver-wrench fa-lg"></i>
                        แก้ไขแผนจัดซื้อครุภัณฑ์</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="hidden" wire:model="edit_id">
                            <span id="year"><i class="fa-solid fa-calendar-days fa-sm"></i> ปีงบประมาณ</span>
                            <select class="form-select @error('year') is-invalid @enderror" wire:model.defer="year"
                                id="year" style="width: 100%;" aria-labelledby="year">
                                @php
                                    $currentYear = date('Y');
                                    $nextYear = $currentYear + 1;
                                    $nextYear2 = $currentYear + 2;
                                    $displayedNextYear = $nextYear + 543;
                                    $displayedNextYear2 = $nextYear2 + 543;

                                @endphp
                                <option value="{{ $nextYear + 543 }}">{{ $displayedNextYear }}</option>
                                <option value="{{ $nextYear2 + 543 }}">{{ $displayedNextYear2 }}</option>
                            </select>
                            @error('year')
                                <span class="text-danger error">โปรดเลือกปีงบประมาณ</span>
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
                            <span id="request_type"><i class="fa-light fa-list fa-sm"></i> ประเภท</span>
                            <select class="form-select @error('request_type') is-invalid @enderror"
                                wire:model.defer="request_type" id="request_type" style="width: 100%;"
                                aria-labelledby="request_type">
                                <option value="" selected>เลือก</option>
                                <option value="" disabled>-------------------------</option>
                                <option value="1">ทดแทน</option>
                                <option value="2">เพิ่มศักย์ภาพ
                                </option>
                            </select>
                            @error('request_type')
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
                                aria-labelledby="description">
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
                            <span id="price_total"><i class="fa-solid fa-tag fa-sm"></i> จำนวน</span>
                            <input class="form-control @error('qty') is-invalid @enderror" wire:model.defer="qty"
                                min="1" id="qty" type="number" style="width: 100%;" autocomplete="off"
                                aria-labelledby="qty">
                            @error('qty')
                                <span class="text-danger error">โปรดใส่จำนวน</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <span id="unit"><i class="fa-solid fa-tag fa-sm"></i> ชื่อหน่วยนับ</span>
                            <input class="form-control @error('unit') is-invalid @enderror" wire:model.defer="unit"
                                id="unit" type="text" style="width: 100%;" maxlength="250"
                                autocomplete="off" placeholder="หน่วย" aria-labelledby="unit">
                            @error('unit')
                                <span class="text-danger error">โปรดใส่ชื่อหน่วยนับและห้ามใส่ตัวเลข</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="reason"><i class="fa-regular fa-comment fa-sm"></i>
                                เหตุผลและความจำเป็น</span>
                            <textarea class="form-control @error('reason') is-invalid @enderror" wire:model.defer="reason" id="reason"
                                style="width: 100%;" col-md-3s="50" rows="2" maxlength="250" autocomplete="off" aria-labelledby="reason"
                                placeholder="เหตุผลและความจำเป็น"></textarea>
                            @error('reason')
                                <span class="text-danger error">โปรดพิมพ์เหตุผลและความจำเป็น</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <span id="remark"><i class="fa-solid fa-quote-left fa-sm"></i> หมายเหตุ</span>
                            <input class="form-control" wire:model.defer="remark" id="remark" type="text"
                                style="width: 100%;" maxlength="250" autocomplete="off" aria-labelledby="remark"
                                placeholder="หมายเหตุ(ถ้ามี)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="closeModal">ปิด</button>
                    <input type="submit" class="btn btn-success" value="แก้ไขข้อมูล">
                </div>
            </form>
        </div>
    </div>
</div>
