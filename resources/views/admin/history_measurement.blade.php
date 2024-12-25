@extends('layouts.general')
@section('pageTitle')
    <h1 class="text-scndBlue text-2xl font-medium" >Lịch sử đo</h1>
@endsection
@section('rightComponents')
    {{-- <div class="w-full flex justify-end"> --}}
    {{-- <input type="text" placeholder="Search..." class="mr-5 placeholder-gray-300 border-transparent bg-vGray rounded-lg min-w-[300px]"> --}}
    {{-- <button class="mr-2 w-auto min-w-[100px] rounded-md font-extrabold py-2 px-3 border-gray-300 text-scndBlue flex-shrink-0 border border-2 border-gray-300">Search</button> --}}
    {{-- </div> --}}
@endsection


@section('insideOverlay')
    {{-- SensorEdit Form --}}
    <div id="sensorForm" class="fixed flex flex-col bg-white w-4/12 h-5/12 shadow-xl rounded-xl opacity-100">

        {{-- exitBtn --}}
        <div class="flex justify-end m-2">
            <button id="exitForm"
                class="text-slate-400 text-xs px-2 py-1 border shadow-sm border-gray-300 bg-gray-100 rounded-md items-center">
            </button>
        </div>

        {{-- fields in the form --}}
        <div class="p-10 pt-2 pb-7 w-full h-full flex-flex-col flex flex-col gap-4">
            <div class="flex flex-row jusfify-between items-center">
                <label for="sensorName" class="w-40 font-bold text-scndBlue ">Cây trồng</label>
                <input type="text" id="sensorName" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="sensorPlace" class="w-40 font-bold text-scndBlue">Loại cây trồng</label>
                <input type="text" id="sensorPlace" class="w-60 rounded-xl border-gray-300 border-1">
            </div>

            <div class="flex flex-row jusfify-between items-center">
                <label for="sensorBattery" class="w-40 font-bold text-scndBlue">Dinh dưỡng đo</label>
                <input type="text" id="sensorBattery" disabled class="w-60 rounded-xl border-gray-300 border-1 disabled:!bg-gray-100" >
            </div> 
            <div class="flex flex-row jusfify-between items-center">
                <label for="sensorBattery" class="w-40 font-bold text-scndBlue">Dinh dưỡng phù hợp</label>
                <input type="text" id="sensorBattery" disabled class="w-60 rounded-xl border-gray-300 border-1 disabled:!bg-gray-100" >
            </div> 

             <div class="flex flex-row jusfify-between items-center">
                <label for="sensorName" class="w-80 font-bold text-scndBlue">Trạng thái</label>
                <select name="status" id="sensorStatus"
                    class="w-80 rounded-xl border-gray-300 border-1 items-center justify-center">
                    <option value="Hoạt động">Hoạt động</option>
                    <option value="Tắt">Tắt</option>
                </select>
            </div>

            <!-- <div class="mt-3 ml-11 mb-0 flex flex-row items-center gap-3 justify-center">
                <button class="p-2 ml-2 px-5 bg-primaryBlue rounded-md text-white">Lưu</button>
                <button class="p-2 px-5 bg-gray-400 rounded-md text-white">Hủy</button>
            </div> -->
        </div>

    </div>
@endsection


@section('content')
    {{-- charts pane --}}
    <!-- <div class="h-64 flex justify-center items-center  rounded-l-2xl rounded-r-2xl" style="background-color: #F3F6FF" id="content">
        <div class="h-52 flex mt-12 mb-10 w-full">

            <div class="flex flex-row px-11 m-0 w-full justify-between" id="theTwoChartPane">
                <div class="chart-container flex flex-1 rounded-2xl items-center justify-center mr-10" style="background-color: #FFFFFF;position: relative; width: 100%;">
                    <canvas id="airChart"></canvas>
                </div>
                @vite('resources/js/charts/airChart.js')


                <div class="chart-container flex flex-1 rounded-2xl items-center justify-center" style="background-color: #FFFFFF;position: relative; width: 100%;">
                    <canvas id="waterChart"></canvas>
                </div>
                @vite('resources/js/charts/waterChart.js')
            </div>
        </div>
    </div> -->


    {{-- search bar --}}

    <div class="w-full flex justify-end">
        {{-- <input type="text" placeholder="Nhập tên cảm biến để tìm kiếm..." --}}
        {{-- class=" mt-15 mb-3 mr-5 placeholder-gray-300 border-transparent bg-vGray rounded-lg min-w-[400px] placeholder-gray-400"> --}}
        {{-- <button class="mr-2 w-auto min-w-[100px] rounded-md font-extrabold py-2 px-3 border-gray-300 text-scndBlue flex-shrink-0 border border-2 border-gray-300">Search</button> --}}
    </div>

    {{-- sensors list --}}
    <div class="flex flex-col gap-3 mt-16 mx-10" >
        <table class="border-collapse rounded-2xl"
            style="border-collapse: separate !important;background-color: #FFFFFF" >
            <thead>
                <tr class="h-20">
                    <th class="px-4 py-2 text-scndBlue">ID</th>
                    <!-- <th class="px-4 py-2 text-scndBlue">Giá Trị Đo</th> -->
                    <th class="px-4 py-2 text-scndBlue">Vị Trí</th>
                    <th class="px-4 py-2 text-scndBlue">Cây phù hợp</th>
                    <th class="px-4 py-2 text-scndBlue">Thời Gian Đo</th>
                    <th class="px-4 py-2 text-scndBlue">Nito</th>
                    <th class="px-4 py-2 text-scndBlue">Kali</th>
                    <th class="px-4 py-2 text-scndBlue">Photpho</th>
                    <!-- <th class="px-4 py-2 text-scndBlue">Trạng Thái</th> -->
                    <th class="px-4 py-2 text-scndBlue">Hành Động</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($measurements as $measurement)
                    <tr class="h-20">
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$measurement['id']}}</td>    
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                         11774142.96057036,1122442.8151397656
                        </td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$measurement['tree_name'] ?? 'undefined'}}
                        </td>
                        
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$measurement['resultTime'] ?? 'undefined'}}</td>
                        
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$measurement['Nito'] ?? 'undefined'}}</td>
                        
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$measurement['Photpho'] ?? 'undefined'}}</td>
                        
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$measurement['Kali'] ?? 'undefined'}}</td>
                        
                        <!-- <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center"> -->
                        <!-- {{$row['S'] ?? 'undefined'}}</td>
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                        {{$row['Ca'] ?? 'undefined'}}</td> -->
                        <td class="px-4 py-2 border-t border-gray-300 border-t-1" style="text-align: center">
                            <button class="rounded-md bg-scndBlue text-white py-2 px-3 mx-1">
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const titlePane = document.getElementById('titlePane');
            console.log(titlePane)
            titlePane.classList.remove('shadow-md');
            titlePane.classList.add('')
        });
    </script> --}}
@endsection
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editBtns = document.querySelectorAll(`[id*="editsensorBtn"]`)
        var overlay = document.getElementById('overlay')

        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                console.log('hehe', this)
                // get data from button
                const name = this.getAttribute('data-name')
                console.log(name)
                const measure = this.getAttribute('data-measure')
                const lastMeasureTime = this.getAttribute('lastMeasureTime')
                const place = this.getAttribute('data-place')
                const status = this.getAttribute('data-status')

                //set data to the form
                document.getElementById('sensorName').value = name
                console.log(document.getElementById('sensorName').value)
                document.getElementById('sensorPlace').value = place
                document.getElementById('sensorStatus').value = status
                document.getElementById('sensorBattery').value = "95%"

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
</script> -->