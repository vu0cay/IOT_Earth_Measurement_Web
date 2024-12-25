<div class="flex">
    <div class="flex flex-1 flex-col gap-7">
        <div class="w-7/12">
            <label for="unitName" class="font-bold text-gray-600">Tên Unit</label>
            <input type="text" class="rounded-xl border-gray-200 mt-1">
        </div>

        <div class="w-7/12">
            <label for="unitName" class="font-bold text-gray-600">Tên thay thế</label>
            <input type="text" class="rounded-xl border-gray-200 mt-1">
        </div>

        <div class="w-7/12">
            <label for="amenityName" class="font-bold text-gray-600">Phân loại unit</label>
            <div>
                <div class="conTent">
                    {{-- search cell --}}
                    <div class="search">
                        <input type="text" class="rounded-xl border-gray-200 mt-1" id="unitCatInput"
                            autocomplete="off">

                        {{-- options --}}
                        <ul class="max-h-40 overflow-auto z-30 w-full rounded-xl mt-2 border-gray-200 border-1 cursor:pointer mr-10 pl-0 hidden"
                            id="unitOptionPane">
                            @foreach ($unitCategories as $cat => $value)
                                <li class="border-gray-200 rounded-xl border-1 mt-1 hover:bg-gray-200 p-3 cursor-pointer"
                                    data-cat="{{ $cat }}">{{ $value }}</li>
                            @endforeach
                        </ul>
                        <ul class="max-h-40 overflow-auto z-30 w-full rounded-xl mt-2 border-gray-200 border-1 cursor:pointer mr-10 pl-0 hidden"
                            id="unitOptionsForSearch">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-7/12">
            <label for="amenityName" class="font-bold text-gray-600">Hỗ trợ cho người khuyết tật</label>
            <div id="selectBox" class="">
                <div class="conTent">
                    {{-- search cell --}}
                    <div class="search">
                        <input type="text" class="rounded-xl border-gray-200 mt-1" id="accessInput"
                            autocomplete="off">

                        {{-- options --}}
                        <ul class="max-h-40 overflow-auto z-30 w-full rounded-xl mt-2 border-gray-200 border-1 cursor:pointer mr-10 pl-0 hidden"
                            id="accessOptionPane">
                            @foreach ($amenityAccessibilities as $cat => $value)
                                <li class="border-gray-200 rounded-xl border-1 mt-1 hover:bg-gray-200 p-3 cursor-pointer"
                                    data-cat="{{ $cat }}">{{ $value }}</li>
                            @endforeach
                        </ul>
                        <ul class="max-h-40 overflow-auto z-30 w-full rounded-xl mt-2 border-gray-200 border-1 cursor:pointer mr-10 pl-0 hidden"
                            id="accessOptionsForSearch">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-7/12">
            <label for="unitName" class="font-bold text-gray-600">Hạn chế</label>
            <input type="text" class="rounded-xl border-gray-200 mt-1">
        </div>

        <div class="w-7/12">
            <label for="unitName" class="font-bold text-gray-600">Tầng</label>
            <input type="text" class="rounded-xl border-gray-200 mt-1">
        </div>
    </div>

    <div class="flex flex-col flex-1 gap-7">
        <div class="w-7/12">
            <label for="unitName" class="font-bold text-gray-600 ">Tọa độ đại diện</label>
            <input type="text" class="rounded-xl border-gray-200 mt-1 placeholder:text-gray-300"
                placeholder="Ví dụ [1.0, 2.0]">
        </div>
        <div class="w-7/12">
            <label for="unitName" class="font-bold text-gray-600 ">Dữ liệu hình học</label>
            <input type="text" class="rounded-xl border-gray-200 mt-1 placeholder:text-gray-300"
                placeholder="Ví dụ [1.0, 2.0]">
        </div>
    </div>


</div>
{{-- @vite('resources/js/features/unit.js') --}}
<script>
    import {
        initComboSearch
    } from "/b-utils/featureFunctions.js";
    document.addEventListener('DOMContentLoaded', function() {
        console.log('UNIT DOM LOADED')
        initComboSearch('unitOptionPane', 'unitCatInput', 'unitOptionsForSearch')
        initComboSearch('accessOptionPane', 'accessInput', 'accessOptionsForSearch')
    })
</script>
