@extends('layouts.general')
@section('pageTitle')
    <h1 class="text-scndBlue text-2xl font-medium" >Sổ tay nông nghiệp</h1>
@endsection



@section('insideOverlay')
    {{-- SensorEdit Form --}}
    <div id="sensorForm" class="fixed flex flex-col bg-white w-4/12 h-5/12 shadow-xl rounded-xl opacity-100">

        {{-- exitBtn --}}
        <div class="flex justify-end m-2">
            <button id="exitForm"
                class="text-slate-400 text-xs px-2 py-1 border shadow-sm border-gray-300 bg-gray-100 rounded-md items-center">
            X
            </button>
        </div>

        {{-- fields in the form --}}
        <div class="p-10 pt-2 pb-7 w-full h-full flex-flex-col flex flex-col gap-4">
            <div class="flex flex-row jusfify-between items-center">
                <label for="tree_name" class="w-40 font-bold text-scndBlue ">Cây trồng</label>
                <input type="text" id="tree_name" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="tree_type" class="w-40 font-bold text-scndBlue">Loại cây trồng</label>
                <input type="text" id="tree_type" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="nutrient_N" class="w-40 font-bold text-scndBlue">N</label>
                <input type="text" id="nutrient_N" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="nutrient_P" class="w-40 font-bold text-scndBlue">P</label>
                <input type="text" id="nutrient_P" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="nutrient_K" class="w-40 font-bold text-scndBlue">K</label>
                <input type="text" id="nutrient_K" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="nutrient_S" class="w-40 font-bold text-scndBlue">S</label>
                <input type="text" id="nutrient_S" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="nutrient_Ca" class="w-40 font-bold text-scndBlue">Ca</label>
                <input type="text" id="nutrient_Ca" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="mt-3 ml-11 mb-0 flex flex-row items-center gap-3 justify-center">
                <button class="p-2 ml-2 px-5 bg-primaryBlue rounded-md text-white">Lưu</button>
                <button class="p-2 px-5 bg-gray-400 rounded-md text-white">Hủy</button>
            </div>
        </div>

    </div>
@endsection


@section('content')
    
    <div class="flex flex-col gap-3 mt-16 mx-10" >
        <!-- <div class="w-full flex justify-end gap-3">
            <div class="search-container">
                <input type="text" id="search-bar" placeholder="Gõ để tìm kiếm..." class="bg-gray-100 border-transparent rounded-md">
                <div class="dropdown" id="dropdown"></div>
            </div>
        </div> -->
        <table class="border-collapse rounded-2xl"
            style="border-collapse: separate !important;background-color: #FFFFFF" >
            <thead>
                <tr class="h-20">
                    <th class="px-4 py-2 text-scndBlue">STT</th>
                    <th class="px-4 py-2 text-scndBlue">Loại cây trồng</th>
                    <!-- <th class="px-4 py-2 text-scndBlue">Giá Trị Đo</th> -->
                    <th class="px-4 py-2 text-scndBlue">Tên</th>
                    <th class="px-4 py-2 text-scndBlue">N (ppm)</th>
                    <!-- <th class="px-4 py-2 text-scndBlue">Trạng Thái</th> -->
                    <th class="px-4 py-2 text-scndBlue">P (ppm)</th>
                    <th class="px-4 py-2 text-scndBlue">K (ppm)</th>
                    <th class="px-4 py-2 text-scndBlue">S (ppm)</th>
                    <th class="px-4 py-2 text-scndBlue">Ca (ppm)</th>
                    <th class="px-4 py-2 text-scndBlue">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr class="h-20">
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['id']}}</td>    
                         <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['type'] ?? 'undefined'}}</td>
                        
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['name'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['N'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['P'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['K'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['S'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['Ca'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                            <button class="rounded-md bg-scndBlue text-white py-2 px-3 mx-1"
                                id="editsensorBtn{{ $row['name'] }}"  
                                data-name="{{ $row['name'] }}"
                                data-type="{{ $row['type'] }}" 
                                data-N="{{ $row['N'] ?? 'undefined' }}"
                                data-P="{{ $row['P'] ?? 'undefined'}}"
                                data-K="{{ $row['K'] ?? 'undefined'}}"
                                data-S="{{ $row['S'] ?? 'undefined'}}"
                                data-Ca="{{ $row['Ca'] ?? 'undefined'}}">
                                Chi tiết
                            </button>
                            <button class="rounded-md bg-red-700 text-white py-2 px-3 mx-1">Xóa</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editBtns = document.querySelectorAll(`[id*="editsensorBtn"]`)
        var overlay = document.getElementById('overlay')

        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // console.log('hehe', this)
                // get data from button
                const name = this.getAttribute('data-name')
                // console.log(name)
                const type = this.getAttribute('data-type')
                const data_N = this.getAttribute('data-N')
                const data_P = this.getAttribute('data-P')
                const data_K = this.getAttribute('data-K')
                const data_S = this.getAttribute('data-S')
                const data_Ca = this.getAttribute('data-Ca')
                
                //set data to the form
                document.getElementById('tree_name').value = name
                document.getElementById('tree_type').value = type
                // console.log(document.getElementById('nutrient_N').value)
                document.getElementById('nutrient_N').value = data_N
                document.getElementById('nutrient_P').value = data_P
                document.getElementById('nutrient_K').value = data_K
                document.getElementById('nutrient_S').value = data_S
                document.getElementById('nutrient_Ca').value = data_Ca

                //blur and darken background
                overlay.classList.remove('hidden')
                document.getElementById('pageBody').classList.add('blur');

            })
        })

        //close form
        var exitBtn = document.getElementById('exitForm')
        exitBtn.addEventListener('click', function() {
            overlay.classList.add('hidden')
            document.getElementById('pageBody').classList.remove('blur');
        })
    })
</script>