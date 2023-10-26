<div wire:ignore.self class="modal fade" id="exampleModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModal2Label" aria-hidden="true" style="height: 100%;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @csrf
            <div class="modal-header" style="background-color: rgb(128, 227, 240)">
                <h5 class="modal-title" id="exampleModal2Label" style="color: black">
                    <i class="fa-solid fa-pen-clip fa-lg"></i> เพิ่มครุภัณฑ์
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                @foreach ($replace_increase_equip as $query)
                    @if ($query->id == $edit_id)
                        <h5> ชื่อรายการ
                            {{ $query->description }}
                        </h5>
                        <p>ราคา {{ number_format($query->price) }} บาท จำนวน
                            {{ $query->qty }}
                            {{ $query->unit }} รวมทั้งหมด {{ number_format($query->price * $query->qty) }} บาท
                        </p>
                    @endif
                @endforeach

                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @elseif (session()->has('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session()->get('warning') }}
                    </div>
                @endif
                <table class="nowarp table table-bordered table-hover table-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">เลือก</th>
                            <th style="text-align: center;">ราคาซื้อจริง(บาท)</th>
                            <th style="text-align: center;">รหัส</th>
                            <th style="text-align: center;">ชื่อรายการ</th>
                            <th style="text-align: center;">ราคาของวัสดุ(บาท)</th>
                            <th style="text-align: center;">อายุการใช้งาน</th>
                            <th style="text-align: center;">สถานะ</th>
                            <th style="text-align: center;">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($replace_equip_detail) > 0)
                            @foreach ($replace_equip_detail as $query)
                                @if ($query->PROC_ID == $edit_id)
                                    <tr>
                                        <td style="text-align: center;">
                                            @if ($query->used == 1)
                                                <input class="form-check-input" type="checkbox"
                                                    wire:click.prevent="CheckedEquip({{ $query->id }})" checked>
                                            @else
                                                <input class="form-check-input" type="checkbox"
                                                    wire:click.prevent="CheckedEquip({{ $query->id }})">
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($query->currentPrice == null)
                                                @if ($editingId == $query->id)
                                                    <input class="form-control" min="1"
                                                        wire:model.defer="currentPrice" id="currentPrice" type="number"
                                                        style="width: 100%;" autocomplete="off"
                                                        placeholder="ราคาซ่อมจริง">
                                                    <button type="button"
                                                        wire:click.prevent="acceptCurrPrice({{ $query->id }})"
                                                        class="btn btn-success btn-sm">ยืนยัน</button>
                                                    <button type="button"
                                                        wire:click.prevent="cancelCurrPrice({{ $query->id }})"
                                                        class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                @else
                                                    <button type="button"
                                                        wire:click.prevent="addCurrPrice({{ $query->id }})"
                                                        class="btn btn-success btn-sm">เพิ่มราคา</button>
                                                @endif
                                            @else
                                                @if ($editingId == $query->id)
                                                    <input class="form-control" min="1"
                                                        wire:model.defer="currentPrice" id="currentPrice" type="number"
                                                        style="width: 100%;" autocomplete="off"
                                                        placeholder="ราคาซ่อมจริง">
                                                    <button type="button"
                                                        wire:click.prevent="acceptCurrPrice({{ $query->id }})"
                                                        class="btn btn-success btn-sm">ยืนยัน</button>
                                                    <button type="button"
                                                        wire:click.prevent="cancelCurrPrice({{ $query->id }})"
                                                        class="btn btn-secondary btn-sm">ยกเลิก</button>
                                                @else
                                                    {{ number_format($query->currentPrice) }}
                                                    <button wire:click.prevent="addCurrPrice({{ $query->id }})"
                                                        class="btn btn-outline-danger btn-sm">
                                                        <i class="fa-solid fa-pen fa-2xs"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                        <td style="text-align: center;">{{ $query->EQUP_ID }}</td>
                                        <td style="text-align: center;">
                                            @if ($editName == $query->id)
                                                <input class="form-control" wire:model.defer="EQUP_NAME" id="EQUP_NAME"
                                                    type="text" style="width: 100%;" autocomplete="off">
                                                <button type="button"
                                                    wire:click.prevent="acceptNameEquip({{ $query->id }})"
                                                    class="btn btn-primary btn-sm">ยืนยัน</button>
                                                <button type="button"
                                                    wire:click.prevent="cancelNameEquip({{ $query->id }})"
                                                    class="btn btn-secondary btn-sm">ยกเลิก</button>
                                            @else
                                                {{ $query->EQUP_NAME }}
                                                <button wire:click.prevent="editNameEquip({{ $query->id }})"
                                                    class="btn btn-outline-danger btn-sm">
                                                    <i class="fa-solid fa-pen fa-2xs"></i>
                                                </button>
                                            @endif
                                        </td>

                                        <td style="text-align: center;">{{ number_format($query->EQUP_PRICE) }}
                                        </td>
                                        <td style="text-align: center;">{{ $query->age }} ปี</td>

                                        <td style="text-align: center;">
                                            @switch($query->EQUP_STS_DESC)
                                                @case('ใช้งาน')
                                                    <span class="badge bg-primary">ยังใช้งาน</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" wire:click="deleteRow({{ $query->id }})"
                                                class="btn btn-outline-danger btn-sm">-</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" style="text-align: center;">ยังไม่ได้เพิ่มข้อมูล</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <form wire:submit.prevent="searchEquipment">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input class="form-control" wire:model.defer="searchEQUIPMENT" type="text"
                                style="width: 100%;" autocomplete="off" placeholder="ค้นหา" id="searchEQUIPMENT"
                                required>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-primary" value="ค้นหา"
                                wire:loading.attr="disabled">
                        </div>
                    </div>
                </form>

                <div wire:loading.remove>
                    @if (session()->has('SearchData'))
                        <div class="alert alert-warning text-center">{{ session('SearchData') }}</div>
                    @elseif (session()->has('noData'))
                        <div class="alert alert-danger text-center">{{ session('noData') }}</div>
                    @else
                        <table class="nowarp table table-bordered table-hover table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">เพิ่ม</th>
                                    <th style="text-align: center;">รหัส</th>
                                    <th style="text-align: center;">ชื่อรายการ</th>
                                    <th style="text-align: center;">ราคาของวัสดุ</th>
                                    <th style="text-align: center;">อายุการใช้งาน</th>
                                    <th style="text-align: center;">แผนก</th>
                                    <th style="text-align: center;">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($VW_EQUIPMENT as $query)
                                    <tr>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-outline-success btn-sm"
                                                wire:click.prevent="selectRow({{ isset($query->EQUP_LINK_NO) ? $query->EQUP_LINK_NO : '' }})">
                                                +
                                            </button>
                                        </td>
                                        <td style="text-align: center;">
                                            {{ isset($query->EQUP_ID) ? $query->EQUP_ID : '' }}</td>
                                        <td style="text-align: center;">
                                            {{ isset($query->EQUP_NAME) ? $query->EQUP_NAME : '' }}</td>
                                        <td style="text-align: center;">
                                            {{ isset($query->EQUP_PRICE) ? number_format($query->EQUP_PRICE) : '' }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ isset($query->age) ? number_format($query->age) : '' }} ปี
                                        </td>
                                        <td style="text-align: center;">
                                            {{ isset($query->TCHN_LOCAT_NAME) ? $query->TCHN_LOCAT_NAME : '' }}
                                        </td>
                                        <td style="text-align: center;">
                                            @switch(isset($query->EQUP_STS_DESC) ? $query->EQUP_STS_DESC : '')
                                                @case('ใช้งาน')
                                                    <span class="badge bg-primary">ยังใช้งาน</span>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $VW_EQUIPMENT->links() }} <!-- เพิ่ม Pagination Links -->
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    wire:click="closeModal">ปิด</button>
            </div>
            </form>
        </div>
    </div>
</div>
