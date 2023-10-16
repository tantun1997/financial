    <div class="row">
        {{-- <div class="col-md-2">
                <span id="year"><i class="fa-solid fa-calendar-days fa-sm"></i> ปีงบประมาณ</span>
                <select class="form-control" id="filterSelectyear" style="width: 100%;"  aria-labelledby="year">
                    <option value="" selected>เลือก</option>
                    @foreach ($years as $years)
                        <option value="{{ $years }}">{{ $years }}</option>
                    @endforeach
                </select>
        </div> --}}
        <div class="col-md-3">
            <span id="deptId"><i class="fa-solid fa-circle-user fa-sm"></i> หน่วยงานที่เบิก</span>
            <select class="form-control " id="filterSelectdeptId" style="width: 100%;" aria-labelledby="deptId">
                <option value="" selected>เลือก</option>
                @foreach ($deptName as $dept)
                    @if (Auth::user()->isAdmin == 'Y')
                        <option value="{{ $dept }}">{{ $dept }}</option>
                    @elseif ($dept == Auth::user()->deptName)
                        <option value="{{ $dept }}">{{ $dept }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        {{-- <div class="col-md-2">
            <span id="objectTypeId"><i class="fa-light fa-list fa-sm"></i> ประเภท</span>
            <select class="form-control " id="filterSelectobjectTypeId" style="width: 100%;"
                aria-labelledby="objectTypeId">
                <option value="" selected>เลือก</option>
                @foreach ($objectName as $objectName)
                    <option value="{{ $objectName }}">{{ $objectName }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="col-md-7 mt-4">
            <button id="resetBtn" class="btn btn-danger">Reset</button>
        </div>
        <div class="col-md-2 mt-4">
            <a id="newButtonContainer" wire:ignore>
                <!-- ที่นี่คือตำแหน่งใหม่ของปุ่ม "Export to Excel" -->
            </a>
        </div>
    </div>
