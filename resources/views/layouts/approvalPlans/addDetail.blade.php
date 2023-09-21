<div wire:ignore.self class="modal fade" id="exampleModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModal2Label" aria-hidden="true" style="height: 100%;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @csrf
            <div class="modal-header" style="background-color: rgb(128, 227, 240)">
                <h5 class="modal-title" id="exampleModal2Label">
                    <i class="fa-solid fa-pen-clip fa-lg"></i> ครุภัณฑ์
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                @foreach ($VW_NEW_MAINPLAN as $query)
                    @if ($query->id == $edit_id)
                        <h5> รายการ
                            {{ $query->description }}
                        </h5>
                        <p>ค่า{{ $query->objectName }} ราคา {{ number_format($query->price) }} บาท จำนวน
                            {{ $query->quant }}
                            {{ $query->package }} รวมทั้งหมด {{ number_format($query->price * $query->quant) }} บาท
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
                            <th style="text-align: center;">รหัส</th>
                            <th style="text-align: center;">ชื่อรายการ</th>
                            <th style="text-align: center;">ราคาของวัสดุ</th>
                            <th style="text-align: center;">สถานะ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($procurements_detail) > 0)
                            @foreach ($procurements_detail as $query)
                                @if ($query->PROC_ID == $edit_id && $query->used == 1)
                                    <tr>
                                        <td style="text-align: center;">{{ $query->EQUP_ID }}</td>
                                        <td style="text-align: center;">{{ $query->EQUP_NAME }}</td>
                                        <td style="text-align: center;">{{ number_format($query->EQUP_PRICE) }}</td>
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
                                <td colspan="5">ยังไม่ได้เพิ่มข้อมูล</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    wire:click="closeModal">ปิด</button>
            </div>
            </form>
        </div>
    </div>
</div>
