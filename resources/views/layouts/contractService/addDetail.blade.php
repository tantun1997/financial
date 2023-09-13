<div wire:ignore.self class="modal fade" id="exampleModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModal2Label" aria-hidden="true" style="height: 100%;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @csrf
            <div class="modal-header" style="background-color: rgb(128, 227, 240)">
                <h5 class="modal-title" id="exampleModal2Label">
                    <i class="fa-solid fa-pen-clip fa-lg"></i> เพิ่มครุภัณฑ์
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">
                {{-- <h4> ID:
                    {{ $edit_id }}
                </h4> --}}
                <h4> รายการ
                    {{ $description }}
                </h4>
                <h5> ราคา {{ $price }} จำนวน {{ $quant }} {{ $package }}
                </h5>
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
                            <th style="text-align: center;">ราคา</th>
                            <th style="text-align: center;">สถานะ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($procurements_detail) === 0)
                            <tr>
                                <td colspan="5">ยังไม่ได้เพิ่มข้อมูล</td>
                            </tr>
                        @else
                            @foreach ($procurements_detail as $query)
                                @if ($query->PROC_ID == $edit_id)
                                    <tr>
                                        <td style="text-align: center;">{{ $query->EQUP_ID }}</td>
                                        <td style="text-align: center;">{{ $query->EQUP_NAME }}</td>
                                        <td style="text-align: center;">{{ number_format($query->EQUP_PRICE) }}</td>
                                        <td style="text-align: center;">
                                            @switch($query->EQUP_STS_DESC)
                                                @case('ใช้งาน')
                                                    <span class="badge bg-success">ใช้งาน</span>
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
                            <input type="submit" class="btn btn-primary" value="ค้นหา" wire:loading.attr="disabled">
                            <div wire:loading>
                                Loading...
                            </div>
                        </div>
                    </div>
                </form>

                <div wire:loading.remove>
                    @if ($searchPerformed)
                        @if (!empty($VW_EQUIPMENT))
                            <table class="nowarp table table-bordered table-hover table-sm" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="text-align: center;">รหัส</th>
                                        <th style="text-align: center;">ชื่อรายการ</th>
                                        <th style="text-align: center;">ราคา</th>
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
                                                {{ isset($query->TCHN_LOCAT_NAME) ? $query->TCHN_LOCAT_NAME : '' }}
                                            </td>
                                            <td style="text-align: center;">
                                                @switch(isset($query->EQUP_STS_DESC) ? $query->EQUP_STS_DESC : '')
                                                    @case('ใช้งาน')
                                                        <span class="badge bg-success">ใช้งาน</span>
                                                    @break
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger text-center" role="alert">ไม่พบข้อมูลที่ค้นหา</div>
                        @endif
                    @else
                        <div class="alert alert-warning text-center" role="alert">พิมพ์ในช่องและกดค้นหา</div>
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
